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
        Schema::create('item_serials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('purchase_id')->nullable()->constrained('purchases')->onDelete('set null');
            $table->foreignId('purchase_return_id')->nullable()->constrained('purchase_returns')->onDelete('set null');
            $table->foreignId('sales_id')->nullable()->constrained('sales')->onDelete('set null');
            $table->foreignId('sales_return_id')->nullable()->constrained('sales_return')->onDelete('set null');
            $table->string('serial_no')->unique();
            $table->enum('status', ['in_stock', 'purchased', 'sold', 'sale_return', 'purchase_return'])->default('in_stock');
            $table->date('warranty_until')->nullable();
            $table->timestamps();

            $table->unique(['item_id', 'serial_no']);
            $table->index('item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_serials');
    }
};
