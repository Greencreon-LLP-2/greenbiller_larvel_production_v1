<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('country_id')->constrained('country_settings')->restrictOnDelete();
            $table->foreignId('group_id')->nullable()->constrained('customer_groups')->nullOnDelete();
            
            $table->string('customer_code', 100);
            $table->string('customer_name', 255);
            $table->string('mobile', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 255)->nullable();
            
            $table->boolean('gst_enabled')->default(false);
            $table->string('gstin', 50)->nullable();
            $table->boolean('vat_enabled')->default(false);
            $table->string('vatin', 50)->nullable();
            $table->string('tax_number', 50)->nullable();
            
            $table->decimal('credit_limit', 12, 2)->default(0.00);
            $table->date('credit_date_limit')->nullable();
            
            $table->enum('price_level_type', ['retail','wholesale','custom'])->default('retail');
            $table->decimal('price_level_value', 12, 2)->default(0.00);
            
            $table->boolean('delete_bit')->default(false);
            $table->enum('status', ['active','inactive'])->default('active');
            
            $table->timestamps();
            
            $table->unique(['store_id','customer_code'], 'uq_customer_code');
            $table->index('store_id', 'idx_customers_store_id');
            $table->index('created_by', 'idx_customers_created_by');
            $table->index('country_id', 'idx_customers_country_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
