<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('file_path', 255);
            $table->string('file_storage_provider', 50)->default('local');
            $table->enum('file_type', ['id_proof','contract','other'])->default('other');
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
            
            $table->index('customer_id', 'idx_customer_attachments_customer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_attachments');
    }
};
