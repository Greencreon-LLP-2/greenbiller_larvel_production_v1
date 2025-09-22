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
        Schema::create('sales_return_charges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_return_id')->constrained('sales_return')->onDelete('cascade');
            $table->enum('charge_type', ['tax', 'discount']);
            $table->decimal('input_value', 15, 2)->default(0.00);
            $table->foreignId('tax_id')->nullable()->constrained('taxes')->onDelete('set null');
            $table->enum('discount_type', ['none', 'fixed', 'percentage'])->default('none');

            $table->index('sales_return_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_return_charges');
    }
};
