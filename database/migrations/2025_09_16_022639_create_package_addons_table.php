<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('package_addons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->string('addon_code', 100);
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->boolean('is_recurring')->default(false);
            $table->unsignedInteger('billing_cycle_id')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->unique(['store_id', 'addon_code'], 'uq_addon_code');
            $table->index('store_id', 'idx_package_addons_store_id');

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('billing_cycle_id')->references('id')->on('billing_cycles');
        });
    }

    public function down(): void {
        Schema::dropIfExists('package_addons');
    }
};
