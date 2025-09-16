<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('item_id');
            $table->decimal('purchase_qty', 15, 2)->default(0);
            $table->decimal('price_per_unit', 15, 2);
            $table->enum('tax_type', ['percent', 'fixed'])->default('percent');
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->enum('discount_type', ['percent', 'fixed', 'none'])->default('none');
            $table->decimal('discount_value', 15, 2)->default(0);
            $table->string('batch_no', 100)->nullable();
            $table->date('expire_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->index('purchase_id', 'idx_purchase_items_purchase_id');
            $table->index('item_id', 'idx_purchase_items_item_id');

            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
