<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journal_entry_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('journal_entry_id');
            $table->unsignedBigInteger('account_id');
            $table->decimal('debit', 15, 2)->default(0.00);
            $table->decimal('credit', 15, 2)->default(0.00);
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->index('journal_entry_id', 'idx_journal_entry_items_entry_id');
            $table->index('account_id', 'idx_journal_entry_items_account_id');

            $table->foreign('journal_entry_id')->references('id')->on('journal_entries')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_entry_items');
    }
};
