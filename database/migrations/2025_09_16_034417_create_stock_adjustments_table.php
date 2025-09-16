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
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->string('reference_no', 100);
            $table->date('adjustment_date');
            $table->text('reason')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            $table->unique(['store_id', 'reference_no'], 'uq_stock_adjust_ref');
            $table->index('store_id', 'idx_stock_adjust_store');
            $table->index('warehouse_id', 'idx_stock_adjust_wh');

            $table->foreign('store_id', 'fk_stock_adjust_store')
                ->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('warehouse_id', 'fk_stock_adjust_wh')
                ->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('created_by', 'fk_stock_adjust_created_by')
                ->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustments');
    }
};
