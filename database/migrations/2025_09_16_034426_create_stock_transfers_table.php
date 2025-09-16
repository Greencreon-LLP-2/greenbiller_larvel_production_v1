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
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->string('transfer_code', 100);
            $table->enum('type', ['store_to_store', 'warehouse_to_warehouse', 'warehouse_to_store', 'store_to_warehouse']);
            $table->unsignedBigInteger('from_store_id')->nullable();
            $table->unsignedBigInteger('to_store_id')->nullable();
            $table->unsignedBigInteger('warehouse_from_id')->nullable();
            $table->unsignedBigInteger('warehouse_to_id')->nullable();
            $table->date('transfer_date');
            $table->string('reference_no', 100)->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->enum('status', ['pending', 'in_transit', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->unique(['store_id', 'transfer_code'], 'uq_stock_transfer_code');
            $table->index('store_id', 'idx_stock_transfers_store');
            $table->index('from_store_id', 'idx_stock_transfers_from_store');
            $table->index('to_store_id', 'idx_stock_transfers_to_store');
            $table->index('warehouse_from_id', 'idx_stock_transfers_wh_from');
            $table->index('warehouse_to_id', 'idx_stock_transfers_wh_to');

            $table->foreign('store_id', 'fk_stock_transfers_store')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('from_store_id', 'fk_stock_transfers_from_store')->references('id')->on('stores')->onDelete('set null');
            $table->foreign('to_store_id', 'fk_stock_transfers_to_store')->references('id')->on('stores')->onDelete('set null');
            $table->foreign('warehouse_from_id', 'fk_stock_transfers_wh_from')->references('id')->on('warehouses')->onDelete('set null');
            $table->foreign('warehouse_to_id', 'fk_stock_transfers_wh_to')->references('id')->on('warehouses')->onDelete('set null');
            $table->foreign('created_by', 'fk_stock_transfers_created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfers');
    }
};
