<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->string('group_name', 100);
            $table->text('description')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();

            $table->unique(['store_id','group_name'], 'uq_group_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_groups');
    }
};
