<?php

namespace App\Http\Controllers\Api\V1\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class SecureFileController
{
    public function fetch(Request $request, $folder, $filename)
    {
        $path = "{$folder}/{$filename}";

        if (! Storage::disk('private')->exists($path)) {
            return response()->json([
                'status' => false,
                'message' => 'File not found',
            ], 404);
        }

        return Response::file(Storage::disk('private')->path($path));

    }
}
