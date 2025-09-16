<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('country_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('mobile_code', 10);
            $table->string('currency_code', 10);
            $table->string('currency_symbol', 10);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('country_settings');
    }
};
