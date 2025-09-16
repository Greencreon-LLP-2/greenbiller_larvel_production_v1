<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id'); // FK → stores(id)
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Unique constraint
            $table->unique(['name', 'store_id'], 'uq_expense_category_name');

            // Indexes
            $table->index('store_id', 'idx_expense_categories_store_id');

            // Foreign key
            $table->foreign('store_id', 'fk_expense_categories_store')
                ->references('id')->on('stores')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expense_categories');
    }
};
