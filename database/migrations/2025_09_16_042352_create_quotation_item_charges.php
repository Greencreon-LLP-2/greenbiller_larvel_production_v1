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
        Schema::create('quotation_item_charges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_item_id')->constrained('quotation_items')->onDelete('cascade');
            $table->enum('charge_type', ['other_charges', 'discount_to_all']);
            $table->decimal('input_value', 15, 2)->default(0.00);
            $table->foreignId('tax_id')->nullable()->constrained('taxes')->onDelete('set null');
            $table->decimal('calculated_amount', 15, 2)->default(0.00);
            $table->enum('discount_type', ['percent', 'fixed'])->default('fixed');

            $table->index('quotation_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_item_charges');
    }
};
