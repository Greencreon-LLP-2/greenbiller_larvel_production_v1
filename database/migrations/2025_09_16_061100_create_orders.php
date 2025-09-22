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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_order_id', 100)->unique();
            $table->unsignedBigInteger('order_status_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('sales_id')->nullable();
            $table->unsignedBigInteger('shipping_address_id')->nullable();
            $table->text('order_address')->nullable();
            $table->decimal('reward_point', 10, 2)->default(0.00);
            $table->decimal('sub_total', 15, 2)->default(0.00);
            $table->decimal('tax_rate', 5, 2)->default(0.00);
            $table->decimal('tax_amt', 15, 2)->default(0.00);
            $table->decimal('delivery_charge', 15, 2)->default(0.00);
            $table->decimal('discount', 15, 2)->default(0.00);
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->decimal('coupon_amount', 15, 2)->default(0.00);
            $table->decimal('handling_charge', 15, 2)->default(0.00);
            $table->decimal('order_totalamt', 15, 2)->default(0.00);
            $table->enum('payment_mode', ['cash', 'card', 'online', 'wallet'])->default('cash');
            $table->decimal('map_distance', 10, 2)->default(0.00);
            $table->string('delivery_pin', 10)->nullable();
            $table->unsignedBigInteger('deliveryboy_id')->nullable();
            $table->unsignedBigInteger('delivery_timeslot_id')->nullable();
            $table->boolean('notifications_admin')->default(false);
            $table->boolean('notifications_store')->default(false);
            $table->boolean('notifications_deliveryboy')->default(false);
            $table->timestamps();

            $table->index('store_id', 'idx_orders_store_id');
            $table->index('customer_id', 'idx_orders_customer_id');
            $table->index('user_id', 'idx_orders_user_id');
            $table->index('sales_id', 'idx_orders_sales_id');
            $table->index('coupon_id', 'idx_orders_coupon_id');
            $table->index('order_status_id', 'idx_orders_order_status_id');
            $table->index('deliveryboy_id', 'idx_orders_deliveryboy_id');
            $table->index('shipping_address_id', 'idx_orders_shipping_address_id');
            $table->index('delivery_timeslot_id', 'idx_orders_delivery_timeslot_id');

            $table->foreign('order_status_id')->references('id')->on('order_status')->onDelete('restrict');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('set null');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('set null');
            // $table->foreign('deliveryboy_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('shipping_address_id')->references('id')->on('addresses')->onDelete('set null');
            // $table->foreign('delivery_timeslot_id')->references('id')->on('delivery_timeslots')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
