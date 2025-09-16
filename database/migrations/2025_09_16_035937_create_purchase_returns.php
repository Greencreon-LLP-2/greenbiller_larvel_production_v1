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
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('return_code', 100);
            $table->string('reference_no', 100)->nullable();
            $table->date('return_date');
            $table->enum('return_status', ['pending', 'partial', 'completed', 'cancelled'])->default('pending');
            $table->text('return_note')->nullable();
            $table->enum('status', ['draft', 'confirmed', 'processed', 'cancelled'])->default('draft');
            $table->timestamps();

            $table->unique(['return_code', 'purchase_id'], 'uq_purchase_return_code');
            $table->index('purchase_id', 'idx_purchase_returns_purchase_id');

            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_returns');
    }
};
