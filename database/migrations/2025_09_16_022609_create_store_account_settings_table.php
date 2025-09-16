<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('store_account_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->string('account_name', 255);
            $table->string('bank_name', 255);
            $table->string('account_number', 50);
            $table->string('ifsc_code', 20);
            $table->string('upi_id', 100)->nullable();
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->index('store_id', 'idx_store_account_settings_store_id');
            $table->index('user_id', 'idx_store_account_settings_user_id');

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::dropIfExists('store_account_settings');
    }
};
