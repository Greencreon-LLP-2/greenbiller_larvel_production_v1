<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('package_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('package_id');
            $table->string('feature_code', 50); // e.g., android_app, windows_app
            $table->boolean('enabled')->default(true);

            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_features');
    }
};
