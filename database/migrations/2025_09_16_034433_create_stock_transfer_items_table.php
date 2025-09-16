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
        Schema::create('stock_transfer_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stock_transfer_id');
            $table->unsignedBigInteger('item_id');
            $table->string('batch_no', 100)->nullable();
            $table->decimal('qty', 18, 4);
            $table->decimal('unit_price', 18, 4)->nullable();
            $table->timestamps();

            $table->index('stock_transfer_id', 'idx_st_items_transfer');
            $table->index('item_id', 'idx_st_items_item');

            $table->foreign('stock_transfer_id', 'fk_st_items_transfer')
                ->references('id')->on('stock_transfers')->onDelete('cascade');
            $table->foreign('item_id', 'fk_st_items_item')
                ->references('id')->on('items')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfer_items');
    }
};
