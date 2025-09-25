<?php

namespace App\Http\Controllers\Api\V1\Public;

use App\Http\Controllers\Controller;
use App\Models\Timezone;
use App\Models\Language;
use App\Models\Currency;
use App\Models\BusinessType;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Get list of countries (mobile codes), timezones, languages, currencies, business types
     */
    public function getAppReferenceData(Request $request)
    {
        try {
            $timezones = Timezone::where('status', 'active')->orderBy('name')->get();
            $languages = Language::where('status', 'active')->orderBy('name')->get();
            $currencies = Currency::where('status', 'active')->orderBy('name')->get();
            $businessTypes = BusinessType::where('status', 'active')->orderBy('name')->get();

            // Example mobile codes array (can replace with DB table if exists)
            $mobileCodes = [
                ['country' => 'India', 'code' => '+91'],
                ['country' => 'USA', 'code' => '+1'],
                ['country' => 'UK', 'code' => '+44'],
                // Add more as needed
            ];

            return response()->json([
                'status' => true,
                'data' => [
                    'mobile_codes' => $mobileCodes,
                    'timezones' => $timezones,
                    'languages' => $languages,
                    'currencies' => $currencies,
                    'business_types' => $businessTypes,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch reference data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
