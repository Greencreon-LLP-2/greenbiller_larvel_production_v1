<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('supplier_code', 50);
            $table->string('supplier_name', 255);
            $table->string('mobile', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('gstin', 50)->nullable();
            $table->string('vatin', 50)->nullable();
            $table->string('postcode', 20)->nullable();
            $table->text('address')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Unique key
            $table->unique(['supplier_code', 'store_id'], 'uq_supplier_code');

            // Foreign keys
            $table->foreign('store_id')
                ->references('id')
                ->on('stores')
                ->onDelete('cascade');

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('country_id')
                ->references('id')
                ->on('country_settings')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
