<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\SmsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserApiControlller extends Controller
{
     public function index(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'API v1 is working!',
            'data' => [
                'timestamp' => now()->toDateTimeString(),
            ],
        ]);
    }
      public function sendOtp(Request $request, SmsService $smsService)
    {
        $request->validate(['mobile' => 'required']);

        $otp = rand(1000, 9999);
        $expiresAt = now()->addMinutes(5);

        // Store OTP temporarily (in cache, not DB)
        cache()->put('otp_' . $request->mobile, [
            'otp' => $otp,
            'expires_at' => $expiresAt
        ], $expiresAt);

        $message = str_replace('{code}', $otp, DB::table('site_config')->value('sms_msg') ?? 'Your OTP code is {code}');
        $smsResponse = $smsService->send($request->mobile, $message);

        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully.',
            'otp' => app()->environment('local') ? $otp : null,
            'sms_response' => $smsResponse
        ]);
    }
}
