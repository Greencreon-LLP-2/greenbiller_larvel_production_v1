<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('customer_group_id')->nullable();
            $table->enum('price_type', ['retail', 'wholesale', 'special', 'mrp', 'cost'])->default('retail');
            $table->decimal('price', 18, 4);
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            $table->unique(
                ['item_id', 'store_id', 'warehouse_id', 'customer_group_id', 'price_type', 'valid_from'],
                'uq_item_price'
            );
            $table->index('item_id', 'idx_item_prices_item');
            $table->index('store_id', 'idx_item_prices_store');

            $table->foreign('item_id', 'fk_item_prices_item')
                ->references('id')->on('items')->onDelete('cascade');

            $table->foreign('store_id', 'fk_item_prices_store')
                ->references('id')->on('stores')->onDelete('cascade');

            // Optional FKs can be added if those tables exist:
            // warehouse_id → warehouses(id)
            // customer_group_id → customer_groups(id)
            // currency_id → currencies(id)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_prices');
    }
};
