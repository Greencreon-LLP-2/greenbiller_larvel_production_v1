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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->string('sales_code', 100)->unique();
            $table->string('reference_no', 100)->nullable();
            $table->date('sales_date');
            $table->date('due_date')->nullable();
            $table->enum('sales_status', ['draft', 'confirmed', 'delivered', 'cancelled'])->default('draft');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('restrict');
            $table->enum('payment_status', ['pending', 'partial', 'paid'])->default('pending');
            $table->foreignId('quotation_id')->nullable()->constrained('quotations')->onDelete('set null');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('set null');
            $table->text('invoice_terms')->nullable();
            $table->enum('status', ['active', 'cancelled'])->default('active');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
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
        Schema::dropIfExists('sales');
    }
};
