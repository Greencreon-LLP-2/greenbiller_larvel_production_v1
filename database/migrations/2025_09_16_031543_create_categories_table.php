<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('code', 100);
            $table->string('name', 255);
            $table->string('image', 255)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('inapp_view', ['visible', 'hidden'])->default('visible');
            $table->timestamps();

            // Unique
            $table->unique(['store_id', 'code'], 'uq_category_code');

            // Indexes
            $table->index('store_id', 'idx_categories_store');
            $table->index('parent_id', 'idx_categories_parent');

            // Foreign keys
            $table->foreign('store_id', 'fk_categories_store')
                ->references('id')->on('stores')
                ->onDelete('cascade');

            $table->foreign('parent_id', 'fk_categories_parent')
                ->references('id')->on('categories')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
