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
        Schema::create('customer_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('transaction_code', 100);
            $table->enum('transaction_type', ['advance', 'payment', 'refund', 'adjustment']);
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->string('related_reference_type', 50)->nullable();
            $table->unsignedBigInteger('related_reference_id')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            // Indexes
            $table->unique(['store_id', 'transaction_code'], 'uq_customer_transactions_code');
            $table->index('store_id', 'idx_customer_transactions_store_id');
            $table->index('customer_id', 'idx_customer_transactions_customer_id');
            $table->index('payment_type_id', 'idx_customer_transactions_payment_type_id');
            $table->index(['related_reference_type', 'related_reference_id'], 'idx_customer_transactions_ref');

            // Foreign keys
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('set null');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_transactions');
    }
};
