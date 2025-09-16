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
        Schema::create('warehouse_stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('item_id');
            $table->string('batch_no', 100)->nullable();
            $table->date('expiry_date')->nullable();
            $table->decimal('available_qty', 18, 4)->default(0.0000);
            $table->decimal('reserved_qty', 18, 4)->default(0.0000);
            $table->timestamps();

            $table->unique(['warehouse_id', 'item_id', 'batch_no'], 'uq_warehouse_item_batch');
            $table->index('warehouse_id', 'idx_warehouse_stock_wh');
            $table->index('item_id', 'idx_warehouse_stock_item');

            $table->foreign('warehouse_id', 'fk_warehouse_stock_warehouse')
                ->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('item_id', 'fk_warehouse_stock_item')
                ->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_stock');
    }
};
