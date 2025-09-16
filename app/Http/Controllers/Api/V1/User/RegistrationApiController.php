<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;

class RegistrationApiController extends Controller
{
    /**
     * Send OTP
     */
    public function sendOtp(Request $request, SmsService $smsService)
    {
        $request->validate(['mobile' => 'required']);

        $otp = rand(1000, 9999);
        $expiresAt = now()->addMinutes(5);

        cache()->put('otp_' . $request->mobile, [
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
            'message' => 'OTP sent successfully',
            'otp' => app()->environment('local') ? $otp : null,
            'sms_response' => $smsResponse,
        ]);
    }

    /**
     * Register user with OTP check
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email'     => 'nullable|email|unique:users,email',
            'mobile'    => 'required|unique:users,mobile',
            'otp'       => 'required',
            'password'  => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $cached = cache()->get('otp_' . $request->mobile);
        if (!$cached || $cached['otp'] != $request->otp) {
            return response()->json(['status' => false, 'message' => 'Invalid or expired OTP'], 400);
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'role_id'       => $request->role_id ?? 4,
                'full_name'     => $request->full_name,
                'email'         => $request->email,
                'mobile'        => $request->mobile,
                'country_code'  => $request->country_code ?? '+91',
                'password'      => Hash::make($request->password),
                'license_key'   => strtoupper(uniqid('LIC-')),
                'referral_code' => strtoupper(uniqid('REF-')),
                'status'        => 'active',
            ]);

            DB::commit();
            cache()->forget('otp_' . $request->mobile);

            // Generate Passport JWT token
            $token = $user->createToken('Personal Access Token')->accessToken;

            return response()->json([
                'status'       => true,
                'message'      => 'User registered successfully',
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'data'         => $user
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Registration error: " . $e->getMessage());

            return response()->json(['status' => false, 'message' => 'Registration failed'], 500);
        }
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login'    => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->login)
            ->orWhere('mobile', $request->login)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
        }

        if ($user->status !== 'active') {
            return response()->json(['status' => false, 'message' => 'Account inactive'], 403);
        }

        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json([
            'status'       => true,
            'message'      => 'Login successful',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'data'         => $user
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['status' => true, 'message' => 'Logged out successfully']);
    }
}
