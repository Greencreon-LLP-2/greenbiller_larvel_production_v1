<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->string('code', 100);
            $table->string('name', 255);
            $table->string('image', 255)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('sku', 100)->nullable();
            $table->string('hsn_code', 100)->nullable();
            $table->string('barcode', 100)->nullable();
            $table->unsignedBigInteger('base_unit_id')->nullable();
            $table->unsignedBigInteger('default_subunit_id')->nullable();
            $table->text('description')->nullable();
            $table->decimal('purchase_price', 18, 4)->nullable();
            $table->decimal('mrp', 18, 4)->nullable();
            $table->unsignedBigInteger('default_tax_id')->nullable();
            $table->boolean('if_expiry')->default(0);
            $table->boolean('if_batch')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            // Unique and indexes
            $table->unique(['store_id', 'code'], 'uq_item_code');
            $table->index('store_id', 'idx_items_store');
            $table->index('category_id', 'idx_items_category');
            $table->index('brand_id', 'idx_items_brand');
            $table->index('base_unit_id', 'idx_items_base_unit');
            $table->index('default_tax_id', 'idx_items_tax');

            // Foreign keys
            $table->foreign('store_id', 'fk_items_store')
                  ->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('category_id', 'fk_items_category')
                  ->references('id')->on('categories')->onDelete('set null');
            $table->foreign('brand_id', 'fk_items_brand')
                  ->references('id')->on('brands')->onDelete('set null');
            $table->foreign('base_unit_id', 'fk_items_base_unit')
                  ->references('id')->on('units')->onDelete('set null');
            $table->foreign('default_subunit_id', 'fk_items_subunit')
                  ->references('id')->on('units')->onDelete('set null');
            $table->foreign('default_tax_id', 'fk_items_default_tax')
                  ->references('id')->on('taxes')->onDelete('set null');
            $table->foreign('created_by', 'fk_items_created_by')
                  ->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
