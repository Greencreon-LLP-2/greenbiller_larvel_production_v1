<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class BaseService
{
    protected function handleException(\Exception $e, string $methodName)
    {
        Log::error("Error in {$methodName}: ".$e->getMessage());

        return [
            'success' => false,
            'message' => 'An error occurred',
            'error' => config('app.debug') ? $e->getMessage() : null,
        ];
    }

    protected function successResponse($data = null, string $message = 'Success', int $code = 200)
    {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ];
    }

    protected function errorResponse(string $message = 'Error', $data = null, int $code = 400)
    {
        return [
            'success' => false,
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ];
    }
}
