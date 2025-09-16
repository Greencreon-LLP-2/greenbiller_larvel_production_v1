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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict');
            $table->string('quote_number', 100)->unique();
            $table->date('quote_date');
            $table->date('due_date')->nullable();
            $table->enum('quotation_status', ['draft', 'sent', 'accepted', 'rejected', 'expired'])->default('draft');
            $table->enum('payment_status', ['pending', 'partial', 'paid'])->default('pending');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->text('invoice_terms')->nullable();
            $table->enum('status', ['active', 'cancelled'])->default('active');
            $table->timestamps();

            $table->index('store_id');
            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
