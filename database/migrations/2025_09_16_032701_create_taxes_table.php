<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('tax_type', ['GST', 'VAT', 'OTHER']);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name', 255);
            $table->decimal('rate', 7, 4);
            $table->enum('group_type', ['IGST', 'CGST', 'SGST', 'NONE'])->default('NONE');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Index
            $table->index('parent_id', 'idx_taxes_parent');

            // Foreign key
            $table->foreign('parent_id', 'fk_taxes_parent')
                ->references('id')->on('taxes')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
