<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->string('package_code', 100);
            $table->string('package_name', 255);
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->boolean('if_multistore')->default(false);
            $table->integer('store_limit')->nullable();
            $table->integer('user_limit')->nullable();
            $table->boolean('is_recurring')->default(true);
            $table->unsignedInteger('billing_cycle_id')->default(1);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->unique(['store_id', 'package_code'], 'uq_package_code');
            $table->index('store_id', 'idx_packages_store_id');

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('billing_cycle_id')->references('id')->on('billing_cycles');
        });
    }

    public function down(): void {
        Schema::dropIfExists('packages');
    }
};
