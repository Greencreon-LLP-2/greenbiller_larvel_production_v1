<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('payment_code', 100);
            $table->date('payment_date');
            $table->unsignedBigInteger('payment_type_id');
            $table->enum('reference_type', ['sale', 'purchase', 'expense', 'order']);
            $table->unsignedBigInteger('reference_id');
            $table->decimal('amount', 12, 2);
            $table->string('transaction_id', 255)->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->unique(['payment_code', 'store_id'], 'uq_payment_code');
            $table->index('store_id', 'idx_payments_store_id');
            $table->index('created_by', 'idx_payments_created_by');
            $table->index(['reference_type', 'reference_id'], 'idx_payments_reference');
            $table->index('payment_type_id', 'idx_payments_payment_type');

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
