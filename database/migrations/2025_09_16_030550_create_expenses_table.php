<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id'); // FK → stores(id)
            $table->unsignedBigInteger('created_by')->nullable(); // FK → users(id)
            $table->string('expense_code', 100);
            $table->date('expense_date');
            $table->unsignedBigInteger('expense_category_id')->nullable(); // FK → expense_categories(id)
            $table->decimal('amount', 12, 2);
            $table->text('note')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            // Unique constraint
            $table->unique(['expense_code', 'store_id'], 'uq_expense_code');

            // Indexes
            $table->index('store_id', 'idx_expenses_store_id');
            $table->index('created_by', 'idx_expenses_created_by');
            $table->index('expense_category_id', 'idx_expenses_category');

            // Foreign keys
            $table->foreign('store_id', 'fk_expenses_store')
                ->references('id')->on('stores')
                ->onDelete('cascade');

            $table->foreign('created_by', 'fk_expenses_created_by')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('expense_category_id', 'fk_expenses_category')
                ->references('id')->on('expense_categories')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
