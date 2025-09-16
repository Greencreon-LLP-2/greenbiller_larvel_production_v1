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
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_id')->constrained('sales')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('restrict');
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->onDelete('set null');
            $table->text('description')->nullable();
            $table->decimal('sales_qty', 15, 2)->default(0.00);
            $table->decimal('price_per_unit', 15, 2)->default(0.00);
            $table->enum('tax_type', ['percent', 'fixed'])->default('percent');
            $table->foreignId('tax_id')->nullable()->constrained('taxes')->onDelete('set null');
            $table->enum('discount_type', ['percent', 'fixed'])->default('fixed');
            $table->decimal('discount_input', 15, 2)->default(0.00);

            $table->index('sales_id');
            $table->index('item_id');
            $table->index('warehouse_id');
            $table->index('tax_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_items');
    }
};
