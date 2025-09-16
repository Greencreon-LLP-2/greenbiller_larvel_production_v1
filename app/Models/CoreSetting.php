<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreSetting extends Model
{
    use HasFactory;

    protected $table = 'core_settings';

    protected $fillable = [
        'site_url',
        'version',
        'app_version',
        'app_package_name',
        'ios_app_version',
        'ios_package_id',
        'site_title',
        'site_description',
        'meta_keywords',
        'meta_details',
        'logo',
        'logo_min',
        'favicon',
        'logo_web',
        'logo_app',
        'address',
        'site_email',
        'whatsapp_number',
        'sendgrid_api',
        'enable_googlemap',
        'enable_firebase',
        'firebase_config',
        'firebase_api_key',
        'enable_cod',
        'enable_bank_transfer',
        'bank_account',
        'upi_id',
        'enable_razorpay',
        'razorpay_key_id',
        'razorpay_key_secret',
        'enable_ccavenue',
        'ccavenue_test_mode',
        'ccavenue_merchant_id',
        'ccavenue_access_code',
        'ccavenue_working_key',
        'enable_phonepe',
        'phonepe_merchant_id',
        'phonepe_salt_key',
        'phonepe_mode',
        'enable_onesignal',
        'onesignal_app_id',
        'onesignal_api_key',
        'smtp_host',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'enable_test_otp',
        'enable_msg91',
        'msg91_api_key',
        'enable_textlocal',
        'textlocal_api_key',
        'enable_greensms',
        'greensms_access_token',
        'greensms_access_token_key',
        'sms_sender_id',
        'sms_entity_id',
        'sms_dlt_id',
        'sms_message_template',
        'maintenance_mode_web',
        'maintenance_mode_app',
        'check_device_id_on_registration',
    ];
}
