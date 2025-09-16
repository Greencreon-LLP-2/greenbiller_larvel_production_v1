<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('core_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_url')->nullable();
            $table->string('version', 50)->nullable();
            $table->string('app_version', 50)->nullable();
            $table->string('app_package_name', 150)->nullable();
            $table->string('ios_app_version', 50)->nullable();
            $table->string('ios_package_id', 150)->nullable();
            $table->string('site_title')->nullable();
            $table->text('site_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_details')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_min')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo_web')->nullable();
            $table->string('logo_app')->nullable();
            $table->string('address')->nullable();
            $table->string('site_email', 150)->nullable();
            $table->string('whatsapp_number', 20)->nullable();
            $table->string('sendgrid_api')->nullable();
            $table->boolean('enable_googlemap')->default(false);
            $table->boolean('enable_firebase')->default(false);
            $table->text('firebase_config')->nullable();
            $table->string('firebase_api_key')->nullable();
            $table->boolean('enable_cod')->default(false);
            $table->boolean('enable_bank_transfer')->default(false);
            $table->string('bank_account')->nullable();
            $table->string('upi_id', 100)->nullable();
            $table->boolean('enable_razorpay')->default(false);
            $table->string('razorpay_key_id')->nullable();
            $table->string('razorpay_key_secret')->nullable();
            $table->boolean('enable_ccavenue')->default(false);
            $table->boolean('ccavenue_test_mode')->default(false);
            $table->string('ccavenue_merchant_id')->nullable();
            $table->string('ccavenue_access_code')->nullable();
            $table->string('ccavenue_working_key')->nullable();
            $table->boolean('enable_phonepe')->default(false);
            $table->string('phonepe_merchant_id')->nullable();
            $table->string('phonepe_salt_key')->nullable();
            $table->enum('phonepe_mode', ['test', 'live'])->default('test');
            $table->boolean('enable_onesignal')->default(false);
            $table->string('onesignal_app_id')->nullable();
            $table->string('onesignal_api_key')->nullable();
            $table->string('smtp_host')->nullable();
            $table->smallInteger('smtp_port')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->boolean('enable_test_otp')->default(false);
            $table->boolean('enable_msg91')->default(false);
            $table->string('msg91_api_key')->nullable();
            $table->boolean('enable_textlocal')->default(false);
            $table->string('textlocal_api_key')->nullable();
            $table->boolean('enable_greensms')->default(false);
            $table->string('greensms_access_token')->nullable();
            $table->string('greensms_access_token_key')->nullable();
            $table->string('sms_sender_id', 50)->nullable();
            $table->string('sms_entity_id', 100)->nullable();
            $table->string('sms_dlt_id', 100)->nullable();
            $table->text('sms_message_template')->nullable();
            $table->boolean('maintenance_mode_web')->default(false);
            $table->boolean('maintenance_mode_app')->default(false);
            $table->boolean('check_device_id_on_registration')->default(false);
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('core_settings');
    }
};
