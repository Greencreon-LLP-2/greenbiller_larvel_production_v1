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
        Schema::create('money_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('transfer_code', 100);
            $table->date('transfer_date');
            $table->unsignedBigInteger('from_account_id')->nullable();
            $table->unsignedBigInteger('to_account_id');
            $table->unsignedBigInteger('payment_type_id');
            $table->decimal('amount', 12, 2);
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->unique(['transfer_code', 'store_id'], 'uq_transfer_code');
            $table->index('store_id', 'idx_money_transfers_store_id');
            $table->index('from_account_id', 'idx_money_transfers_from_account');
            $table->index('to_account_id', 'idx_money_transfers_to_account');
            $table->index('created_by', 'idx_money_transfers_created_by');
            $table->index('payment_type_id', 'idx_money_transfers_payment_type');

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('from_account_id')->references('id')->on('accounts')->onDelete('set null');
            $table->foreign('to_account_id')->references('id')->on('accounts')->onDelete('restrict');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money_transfers');
    }
};
