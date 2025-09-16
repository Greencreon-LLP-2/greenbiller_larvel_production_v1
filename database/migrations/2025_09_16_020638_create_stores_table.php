<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_by');
            $table->string('store_code', 100)->unique();
            $table->string('slug', 150)->unique()->nullable();
            $table->string('name', 255);
            $table->string('website', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('logo', 255)->nullable();
            $table->unsignedBigInteger('country_id');
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('postcode', 20)->nullable();
            $table->boolean('gst_enabled')->default(0);
            $table->string('gst_no', 50)->nullable();
            $table->boolean('vat_enabled')->default(0);
            $table->string('vat_no', 50)->nullable();
            $table->string('pan_no', 50)->nullable();
            $table->decimal('default_sales_discount', 10, 2)->default(0.00);
            $table->unsignedBigInteger('language_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->enum('currency_placement', ['left', 'right', 'left_space', 'right_space'])->default('left');
            $table->unsignedBigInteger('timezone_id')->nullable();
            $table->string('date_format', 20)->default('Y-m-d');
            $table->string('time_format', 20)->default('H:i');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Indexes
            $table->index('status');
            $table->index('created_by');

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('country_id')->references('id')->on('country_settings');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('timezone_id')->references('id')->on('timezones');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
