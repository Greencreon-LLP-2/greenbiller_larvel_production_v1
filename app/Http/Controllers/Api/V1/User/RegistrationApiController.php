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
use Illuminate\Support\Facades\Validator;

class RegistrationApiController extends Controller
{
    /**
     * Send OTP
     */
    public function sendOtp(Request $request, SmsService $smsService)
    {
        $mobile = $request->input('mobile');

        $request->validate([
            'mobile' => 'required|string|digits:10',
        ]);

        $otp = rand(1000, 9999);
        $expiresAt = now()->addMinutes(5);

        cache()->put('otp_'.$request->mobile, [
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ], $expiresAt);

        $message = str_replace(
            '{code}',
            $otp,
            DB::table('core_settings')->value('sms_message_template') ?? 'Your OTP code is {code}'
        );

        $smsResponse = $smsService->send($request->mobile, $message);

        return response()->json([
            'status' => true,
            'mobile' => $mobile,
            'message' => 'OTP sent successfully',
            'otp' => app()->environment('local') ? $otp : null,
            // 'sms_response' => $smsResponse,
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
            'mobile' => 'required|unique:users,mobile',
            'otp' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $cached = cache()->get('otp_'.$request->mobile);
        if (! $cached || $cached['otp'] != $request->otp) {
            return response()->json(['status' => false, 'message' => 'Invalid or expired OTP'], 400);
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
            cache()->forget('otp_'.$request->mobile);

            // Generate Passport JWT token
            $token = $user->createToken('Personal Access Token')->accessToken;

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'data' => $user,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration error: '.$e->getMessage());

            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
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

        // Require at least one identifier
        if (! $request->email && ! $request->mobile) {
            return response()->json([
                'status' => false,
                'message' => 'Email or mobile number is required',
            ], 422);
        }

        // Require at least one authentication method
        if (! $request->password && ! $request->otp) {
            return response()->json([
                'status' => false,
                'message' => 'Password or OTP is required',
            ], 422);
        }

        // Find user by email or mobile
        $userQuery = User::query();
        if ($request->email) {
            $userQuery->where('email', $request->email);
        }
        if ($request->mobile) {
            $userQuery->orWhere('mobile', $request->mobile);
        }

        $user = $userQuery->first();

        if (! $user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);
        }

        // Authenticate using OTP
        if ($request->otp) {
            $cacheKey = 'otp_'.($request->mobile ?? $request->email);
            $cached = cache()->get($cacheKey);
            if (! $cached || $cached['otp'] != $request->otp) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid or expired OTP',
                ], 400);
            }
        }
        // Authenticate using password
        elseif ($request->password) {
            if (! Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials',
                ], 401);
            }
        }

        // Check user status
        if ($user->status !== 'active') {
            $statusMessages = [
                'deleted' => 'Account has been deleted',
                'suspended' => 'Account is suspended',
                'inactive' => 'Account is inactive',
                'banned' => 'Account is banned',
            ];

            $message = $statusMessages[$user->status] ?? 'Account inactive';

            return response()->json([
                'status' => false,
                'message' => $message,
            ], 403);
        }

        // Create token
        $token = $user->createToken('Personal Access Token')->accessToken;

        // Exclude sensitive fields
        $userData = $user->makeHidden(['password', 'remember_token', 'otp']);

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $userData,
        ]);
    }
    /**
     * Logout
     */
    public function logout(Request $request)
    {
        /** @var \Laravel\Passport\Token $token */
        $token = $request->user()->token();
        $token->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    public function statusUpdate(Request $request)
    {
       
        $request->validate([
            'user_id' => 'required|integer|min:1|max:1000000',
            'status' => 'required|in:active,deleted,suspended,inactive,banned',
        ]);
        
        $userId = $request->input('user_id');
        $status = $request->input('status');

        try {
           
            $user = User::findOrFail($userId);

            // Revoke all existing tokens
            $user->tokens()->update(['revoked' => true]);

            // Update status
            $user->status = $status;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => "User status updated to {$status}",
                'userId' => $userId,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
                'user_id' => $userId,
            ], 404);
        }
    }

    public function adminUserdelete(Request $request)
    {
        $userId = $request->input('user_id');

        $request->validate([
            'user_id' => 'required|integer|min:1|max:1000000',
        ]);
        try {
            $user = User::findOrFail($userId);
            $user->delete();

            // $request->user()->tokens()->update(['revoked' => true]);
            // $user->status='deleted';
            // $user->save();
            return response()->json([
                'status' => true,
                'message' => 'User status updated to deleted',
                'userId' => $userId,
            ]);
        } catch (ModelNotFoundException $e) {
            // Failure: user not found
            return response()->json([
                'status' => false,
                'message' => 'User not found',
                'user_id' => $userId,
            ], 404);
        }
    }
}
