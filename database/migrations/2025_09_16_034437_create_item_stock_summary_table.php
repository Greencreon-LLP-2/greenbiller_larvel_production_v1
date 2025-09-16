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
        Schema::create('item_stock_summary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('item_id');
            $table->decimal('total_available', 18, 4)->default(0.0000);
            $table->decimal('total_reserved', 18, 4)->default(0.0000);
            $table->timestamp('last_updated')->nullable()->useCurrentOnUpdate();

            $table->unique(['store_id', 'item_id'], 'uq_item_stock_summary');
            $table->index('store_id', 'idx_item_stock_summary_store');
            $table->index('item_id', 'idx_item_stock_summary_item');

            $table->foreign('store_id', 'fk_item_stock_summary_store')
                ->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('item_id', 'fk_item_stock_summary_item')
                ->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_stock_summary');
    }
};
