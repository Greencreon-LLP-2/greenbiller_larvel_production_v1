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
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('payment_code', 100);
            $table->date('payment_date');
            $table->unsignedBigInteger('payment_type_id');
            $table->string('reference_no', 100)->nullable();
            $table->decimal('amount', 12, 2);
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->unique(['payment_code', 'store_id'], 'uq_purchase_payment_code');
            $table->index('purchase_id', 'idx_purchase_payments_purchase_id');
            $table->index('store_id', 'idx_purchase_payments_store_id');
            $table->index('payment_type_id', 'idx_purchase_payments_payment_type_id');

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('restrict');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_payments');
    }
};
