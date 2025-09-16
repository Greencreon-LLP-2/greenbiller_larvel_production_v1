<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('unit_conversions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('base_unit_id');
            $table->unsignedBigInteger('sub_unit_id');
            $table->decimal('factor', 18, 6);
            $table->string('note', 255)->nullable();
            $table->timestamps();

            // Unique key and indexes
            $table->unique(['base_unit_id', 'sub_unit_id'], 'uq_unitconv');
            $table->index('base_unit_id', 'idx_unitconv_base');
            $table->index('sub_unit_id', 'idx_unitconv_sub');

            // Foreign keys
            $table->foreign('base_unit_id', 'fk_unitconv_base')
                ->references('id')->on('units')->onDelete('cascade');
            $table->foreign('sub_unit_id', 'fk_unitconv_sub')
                ->references('id')->on('units')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_conversions');
    }
};
