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
        Schema::create('stock_adjustment_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('adjustment_id');
            $table->unsignedBigInteger('warehouse_stock_id')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->string('batch_no', 100)->nullable();
            $table->decimal('qty_change', 18, 4);
            $table->decimal('qty_before', 18, 4)->nullable();
            $table->decimal('qty_after', 18, 4)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index('adjustment_id', 'idx_sa_items_adjustment');
            $table->index('item_id', 'idx_sa_items_item');

            $table->foreign('adjustment_id', 'fk_sa_items_adjustment')
                ->references('id')->on('stock_adjustments')->onDelete('cascade');
            $table->foreign('warehouse_stock_id', 'fk_sa_items_warehouse_stock')
                ->references('id')->on('warehouse_stock')->onDelete('set null');
            $table->foreign('item_id', 'fk_sa_items_item')
                ->references('id')->on('items')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustment_items');
    }
};
