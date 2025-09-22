<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = Carbon::now();

        DB::table('core_settings')->insert([
            [
                'site_url' => 'https://greenbiller.in',
                'version' => '1.0.0',
                'app_version' => '1.0.1',
                'app_package_name' => null,
                'ios_app_version' => null,
                'ios_package_id' => null,
                'site_title' => 'Green Biller',
                'site_description' => 'A simple and effective billing solution',
                'meta_keywords' => 'billing, invoice, POS',
                'meta_details' => 'Green Biller application settings',
                'logo' => '1753984531_logo.jpeg',
                'logo_min' => '1756536080_min_logo.jpeg',
                'favicon' => '1754319600_fav_icon.jpeg',
                'logo_web' => null,
                'logo_app' => null,
                'address' => 'Kerala, India',
                'site_email' => 'samy@gmail.com',
                'whatsapp_number' => '8925167743',
                'sendgrid_api' => null,
                'enable_googlemap' => true,
                'enable_firebase' => true,
                'firebase_config' => null,
                'firebase_api_key' => null,
                'enable_cod' => true,
                'enable_bank_transfer' => true,
                'bank_account' => null,
                'upi_id' => null,
                'enable_razorpay' => true,
                'razorpay_key_id' => '78945yicUJjzeSibdLI3rNV7OkuAG',
                'razorpay_key_secret' => '1233yicUJjzeSibdLI3rNV7OkuAG',
                'enable_ccavenue' => false,
                'ccavenue_test_mode' => true,
                'ccavenue_merchant_id' => 'mer45',
                'ccavenue_access_code' => 'sdfsdf',
                'ccavenue_working_key' => '789fgtt',
                'enable_phonepe' => true,
                'phonepe_merchant_id' => '33333',
                'phonepe_salt_key' => 'asdsdf',
                'phonepe_mode' => 'test', // Must match enum: 'test' or 'live'
                'enable_onesignal' => true,
                'onesignal_app_id' => 'qqqqq',
                'onesignal_api_key' => null,
                'smtp_host' => null,
                'smtp_port' => null,
                'smtp_username' => null,
                'smtp_password' => null,
                'enable_test_otp' => true,
                'enable_msg91' => true,
                'msg91_api_key' => null,
                'enable_textlocal' => true,
                'textlocal_api_key' => null,
                'enable_greensms' => true,
                'greensms_access_token' => '9UJI3Q66LF10989',
                'greensms_access_token_key' => '7Frj/LeP5HT&i1gE9bx)D4h28Jw0UmZ(',
                'sms_sender_id' => 'GRNLLP',
                'sms_entity_id' => '1701174193705338165',
                'sms_dlt_id' => '1707174244761113638',
                'sms_message_template' => '{code} is your OTP for login . OTP is valid for 8 minutes. Do not share this OTP with anyone. Powered by Greencreon LLP',
                'maintenance_mode_web' => false,
                'maintenance_mode_app' => false,
                'check_device_id_on_registration' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('core_settings')->truncate();
    }
};
