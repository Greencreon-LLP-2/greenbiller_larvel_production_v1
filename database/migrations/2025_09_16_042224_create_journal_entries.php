<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('journal_code', 100);
            $table->date('entry_date');
            $table->enum('reference_type', ['sale', 'purchase', 'return', 'payment', 'expense', 'adjustment', 'transfer'])->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'posted', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->unique(['journal_code', 'store_id'], 'uq_journal_code');
            $table->index('store_id', 'idx_journal_entries_store_id');
            $table->index('created_by', 'idx_journal_entries_created_by');

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};
