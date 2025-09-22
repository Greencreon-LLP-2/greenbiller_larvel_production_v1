<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegistrationApiController extends Controller
{
    /**
     * Send OTP
     */
    public function sendOtp(Request $request, SmsService $smsService)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $mobile = $request->mobile;
        $otp = rand(1000, 9999);
        $expiresAt = now()->addMinutes(5);

        cache()->put("otp_{$mobile}", [
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ], $expiresAt);

        $template = DB::table('core_settings')->value('sms_message_template') ?? 'Your OTP code is {code}';
        $message = str_replace('{code}', $otp, $template);

        $smsService->send($mobile, $message);

        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully',
            'mobile' => $mobile,
            'otp' => app()->environment('local') ? $otp : null, // expose only in local/dev
        ]);
    }

    /**
     * Register user with OTP check
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'mobile' => 'required|string|unique:users,mobile',
            'otp' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $cached = cache()->get("otp_{$request->mobile}");
        if (! $cached || $cached['otp'] != $request->otp) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired OTP',
            ], 400);
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'role_id' => $request->role_id ?? 4,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country_code' => $request->country_code ?? '+91',
                'password' => Hash::make($request->password),
                'license_key' => strtoupper(uniqid('LIC-')),
                'referral_code' => strtoupper(uniqid('REF-')),
                'status' => 'active',
            ]);

            DB::commit();
            cache()->forget("otp_{$request->mobile}");

            $token = $user->createToken('Personal Access Token')->accessToken;

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'data' => $user->makeHidden(['password', 'remember_token']),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration error: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Registration failed',
            ], 500);
        }
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email',
            'mobile' => 'nullable|string',
            'password' => 'nullable|string',
            'otp' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        if (! $request->email && ! $request->mobile) {
            return response()->json([
                'status' => false,
                'message' => 'Email or mobile number is required',
            ], 422);
        }

        if (! $request->password && ! $request->otp) {
            return response()->json([
                'status' => false,
                'message' => 'Password or OTP is required',
            ], 422);
        }

        $user = User::query()
            ->when($request->email, fn ($q) => $q->where('email', $request->email))
            ->when($request->mobile, fn ($q) => $q->orWhere('mobile', $request->mobile))
            ->first();

        if (! $user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);
        }

        if ($request->otp) {
            $cacheKey = 'otp_'.($request->mobile ?? $request->email);
            $cached = cache()->get($cacheKey);
            if (! $cached || $cached['otp'] != $request->otp) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid or expired OTP',
                ], 400);
            }
        } elseif ($request->password) {
            if (! Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials',
                ], 401);
            }
        }

        if ($user->status !== 'active') {
            $statusMessages = [
                'deleted' => 'Account has been deleted',
                'suspended' => 'Account is suspended',
                'inactive' => 'Account is inactive',
                'banned' => 'Account is banned',
            ];

            return response()->json([
                'status' => false,
                'message' => $statusMessages[$user->status] ?? 'Account inactive',
            ], 403);
        }

        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user->makeHidden(['password', 'remember_token']),
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        /** @var \Laravel\Passport\Token $token */
        $request->user()->token()->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Update user status
     */
    public function statusUpdate(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:active,deleted,suspended,inactive,banned',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user->tokens()->update(['revoked' => true]);
            $user->status = $request->status;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => "User status updated to {$request->status}",
                'user_id' => $user->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Status update error: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Status update failed',
            ], 500);
        }
    }

    /**
     * Delete user by Admin
     */
    public function adminUserDelete($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent admin from deleting themselves
            if ($user->id === auth()->id()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot delete your own account',
                ], 422);
            }

            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully',
                'user_id' => $id,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
                'user_id' => $id,
            ], 404);
        }
    }

    /**
     * Check user existence
     */
    public function checkUserExistence(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email',
            'mobile' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        if (! $request->email && ! $request->mobile) {
            return response()->json([
                'status' => false,
                'message' => 'Email or mobile number is required',
            ], 422);
        }

        $user = User::query()
            ->when($request->email, fn ($q) => $q->where('email', $request->email))
            ->when($request->mobile, fn ($q) => $q->orWhere('mobile', $request->mobile))
            ->first();

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User exists',
                'user_id' => $user->id,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'User not found',
        ], 404);
    }

    public function updateProfile(Request $request)
    {
       
        $user = $request->user();

        $validated = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,'.$user->id,
            'mobile' => 'sometimes|string|unique:users,mobile,'.$user->id,
            'password' => 'sometimes|string|min:8|confirmed',
            'dob' => 'sometimes|date',
            'whatsapp_no' => 'sometimes|string|max:20',
            'zone' => 'sometimes|string|max:255',
            'profile_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            // Handle password hashing
            if (! empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            }

            // Handle profile image upload - FIXED
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $filename = uniqid('profile_').'.'.$file->getClientOriginalExtension();

                // Store in PUBLIC disk (storage/app/public/profile_images)
                $path = $file->storeAs('profile_images', $filename, 'private');

                // Delete old profile image if exists
                if ($user->profile_image && Storage::disk('private')->exists($user->profile_image)) {
                    Storage::disk('private')->delete($user->profile_image);
                }

                $validated['profile_image'] = $path; // This should save: 'profile_images/filename.jpg'
            }

         

            $user->update($validated);

            // Refresh user data from database
            $user->refresh();

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
                'data' => $user->makeHidden(['password', 'remember_token', 'otp']),
            ]);

        } catch (\Exception $e) {


            return response()->json([
                'status' => false,
                'message' => 'Profile update failed: '.$e->getMessage(),
            ], 500);
        }
    }

    public function getProfile(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'status' => true,
            'data' => $user->makeHidden(['password', 'remember_token', 'otp']),
        ]);
    }
}
