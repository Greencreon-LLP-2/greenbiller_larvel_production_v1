<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->string('account_name', 255);
            $table->enum('account_type', [
                'asset', 'liability', 'equity', 'revenue', 'expense', 'customer', 'supplier', 'other'
            ]);
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('expense_id')->nullable();
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->unique(['account_name', 'store_id'], 'uq_account_name');
            $table->index('store_id', 'idx_accounts_store_id');

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
            $table->foreign('expense_id')->references('id')->on('expenses')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
