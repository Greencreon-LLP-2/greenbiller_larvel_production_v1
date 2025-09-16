<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('subscription_purchase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('counter_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('subscription_code', 100);
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('amount', 12, 2);
            $table->unsignedBigInteger('payment_type_id');
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->timestamps();

            $table->unique(['store_id', 'subscription_code'], 'uq_subscription_code');

            $table->index('store_id', 'idx_subscription_purchase_store_id');
            $table->index('package_id', 'idx_subscription_purchase_package_id');
            $table->index('counter_id', 'idx_subscription_purchase_counter_id');
            $table->index('created_by', 'idx_subscription_purchase_created_by');
            $table->index('payment_type_id', 'idx_subscription_purchase_payment_type_id');

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('restrict');
            $table->foreign('counter_id')->references('id')->on('store_counters')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('restrict');
        });
    }

    public function down(): void {
        Schema::dropIfExists('subscription_purchase');
    }
};
