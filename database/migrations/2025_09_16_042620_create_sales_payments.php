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
        Schema::create('sales_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->foreignId('sales_id')->constrained('sales')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('payment_code', 100);
            $table->date('payment_date');
            $table->foreignId('payment_type_id')->constrained('payment_types')->onDelete('restrict');
            $table->string('reference_no', 100)->nullable();
            $table->decimal('amount', 12, 2);
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->unique(['payment_code', 'store_id']);
            $table->index('sales_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_payments');
    }
};
