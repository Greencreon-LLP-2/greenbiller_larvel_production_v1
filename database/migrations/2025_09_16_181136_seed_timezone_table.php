<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    public function up(): void
    {
        $timezones = [
            'Asia/Kolkata',       // India
            'Asia/Dubai',         // UAE
            'Asia/Riyadh',        // Saudi Arabia
            'Asia/Qatar',         // Qatar
            'Asia/Bahrain',       // Bahrain
            'Asia/Kuwait',        // Kuwait
            'Asia/Muscat',        // Oman
            'Asia/Baghdad',       // Iraq
            'Asia/Amman',         // Jordan
            'Asia/Beirut',        // Lebanon
        ];

        foreach ($timezones as $zone) {
            DB::table('timezones')->insert([
                'name' => $zone,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('timezones')->truncate();
    }
};
