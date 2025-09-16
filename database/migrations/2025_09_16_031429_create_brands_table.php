<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->string('slug', 255)->nullable();
            $table->string('code', 100);
            $table->string('name', 255);
            $table->string('image', 255)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('inapp_view', ['visible', 'hidden'])->default('visible');
            $table->timestamps();

            // Unique
            $table->unique(['store_id', 'code'], 'uq_brand_code');

            // Index
            $table->index('store_id', 'idx_brands_store');

            // Foreign key
            $table->foreign('store_id', 'fk_brands_store')
                ->references('id')->on('stores')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
