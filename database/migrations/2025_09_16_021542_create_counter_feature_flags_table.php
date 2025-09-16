<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('counter_feature_flags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('counter_id');
            $table->string('feature_name', 50);
            $table->boolean('enabled')->default(false);

            // Foreign key
            $table->foreign('counter_id')
                ->references('id')
                ->on('store_counters')
                ->onDelete('cascade');

            // Unique key
            $table->unique(['counter_id', 'feature_name'], 'uniq_counter_feature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('counter_feature_flags');
    }
};
