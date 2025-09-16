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
        Schema::create('orders_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->decimal('selling_price', 15, 2)->default(0.00);
            $table->decimal('qty', 15, 2)->default(0.00);
            $table->decimal('tax_rate', 5, 2)->default(0.00);
            $table->enum('tax_type', ['percent', 'fixed'])->default('percent');
            $table->decimal('tax_amt', 15, 2)->default(0.00);
            $table->enum('discount_type', ['none', 'fixed', 'percentage'])->default('none');
            $table->decimal('discount_value', 15, 2)->default(0.00);
            $table->decimal('total_price', 15, 2)->default(0.00);
            $table->boolean('if_offer')->default(false);
            $table->timestamps();

            $table->index('order_id', 'idx_orders_items_order_id');
            $table->index('item_id', 'idx_orders_items_item_id');
            $table->index('warehouse_id', 'idx_orders_items_warehouse_id');

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('restrict');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_items');
    }
};
