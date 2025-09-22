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
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('purchase_code', 100);
            $table->string('bill_number', 100)->nullable();
            $table->string('reference_no', 100)->nullable();
            $table->date('purchase_date');
            $table->text('purchase_note')->nullable();
            $table->enum('status', ['draft', 'confirmed', 'received', 'cancelled'])->default('draft');
            $table->timestamps();

            $table->unique(['purchase_code', 'store_id'], 'uq_purchase_code');

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('restrict');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
