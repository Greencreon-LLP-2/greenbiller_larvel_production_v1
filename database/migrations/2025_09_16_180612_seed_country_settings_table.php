<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    public function up(): void
    {
        $countries = [
            ['India', '+91', 'INR', '₹', true],
            ['United States', '+1', 'USD', '$', true],
            ['United Kingdom', '+44', 'GBP', '£', true],
            ['Canada', '+1', 'CAD', '$', true],
            ['Australia', '+61', 'AUD', '$', true],
            ['Germany', '+49', 'EUR', '€', true],
            ['France', '+33', 'EUR', '€', true],
            ['Japan', '+81', 'JPY', '¥', true],
            ['China', '+86', 'CNY', '¥', true],
            ['United Arab Emirates', '+971', 'AED', 'د.إ', true],
        ];

        foreach ($countries as $country) {
            DB::table('country_settings')->insert([
                'name' => $country[0],
                'mobile_code' => $country[1],
                'currency_code' => $country[2],
                'currency_symbol' => $country[3],
                'status' => $country[4],
                'created_at' => Carbon::parse('2025-08-30 09:39:11'),
                'updated_at' => Carbon::parse('2025-08-30 09:39:11'),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('country_settings')->truncate();
    }
};
