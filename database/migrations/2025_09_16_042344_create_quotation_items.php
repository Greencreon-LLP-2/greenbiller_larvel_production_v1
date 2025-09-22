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
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('restrict');
            $table->decimal('quantity', 15, 2)->default(1.00);
            $table->decimal('price_per_unit', 15, 2)->default(0.00);
            $table->foreignId('tax_id')->nullable()->constrained('taxes')->onDelete('set null');
            $table->enum('discount_type', ['none', 'percent', 'fixed'])->default('none');
            $table->decimal('discount_value', 15, 2)->default(0.00);
            $table->string('unit', 50)->nullable();
            $table->string('batch_no', 100)->nullable();
            $table->text('serial_numbers')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->index('quotation_id');
            $table->index('item_id');
            $table->index('tax_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};
