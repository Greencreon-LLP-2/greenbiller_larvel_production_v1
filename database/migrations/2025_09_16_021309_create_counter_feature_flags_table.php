<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('counter_document_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('counter_id');
            $table->enum('doc_type', ['invoice', 'pos', 'quotation']);
            $table->enum('printer_type', ['thermal', 'dot_matrix', 'inkjet', 'a4']);
            $table->enum('page_size', ['a4', 'a5', '3inch', '2inch']);
            
            $table->boolean('show_mrp')->default(false);
            $table->boolean('show_paid_amount')->default(false);
            $table->boolean('show_return')->default(false);
            $table->boolean('number_to_word')->default(false);
            $table->boolean('show_previous_balance')->default(false);
            $table->text('invoice_notes')->nullable();
            $table->boolean('copy_customer_enabled')->default(false);
            $table->string('business_logo', 255)->nullable();
            $table->string('template', 100)->nullable();
            $table->string('signature_image', 255)->nullable();
            $table->text('footer_terms_conditions')->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('counter_id')
                ->references('id')
                ->on('store_counters')
                ->onDelete('cascade');

            // Unique constraint
            $table->unique(['counter_id', 'doc_type'], 'uniq_counter_doc');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('counter_document_settings');
    }
};
