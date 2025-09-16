<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->enum('type', ['default', 'custom'])->default('custom');
            $table->string('name', 255);
            $table->text('address')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Index
            $table->index('store_id', 'idx_warehouses_store');

            // Foreign key
            $table->foreign('store_id', 'fk_warehouses_store')
                ->references('id')->on('stores')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
