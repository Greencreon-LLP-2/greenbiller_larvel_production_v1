<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Addresses table
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('address_type', ['billing', 'shipping', 'other'])->default('shipping');
            $table->unsignedBigInteger('country_id');
            $table->string('state', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('postcode', 20)->nullable();
            $table->text('address_line')->nullable();
            $table->string('location_link', 255)->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->index('country_id', 'idx_addresses_country_id');
            $table->foreign('country_id', 'fk_addresses_country')
                ->references('id')->on('country_settings')
                ->onDelete('restrict');
        });

        // Address links table
        Schema::create('address_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('address_id');
            $table->enum('entity_type', ['store', 'customer', 'supplier', 'user']);
            $table->unsignedBigInteger('entity_id');

            $table->unique(['address_id', 'entity_type', 'entity_id'], 'uq_address_entity');
            $table->foreign('address_id', 'fk_address_links_address')
                ->references('id')->on('addresses')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('address_links');
        Schema::dropIfExists('addresses');
    }
};
