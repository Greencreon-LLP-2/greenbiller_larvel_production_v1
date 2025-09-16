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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('user_roles')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('system_modules')->onDelete('cascade');
            $table->boolean('can_view')->default(1);
            $table->boolean('can_create')->default(0);
            $table->boolean('can_update')->default(0);
            $table->boolean('can_delete')->default(0);
            $table->timestamps();
            $table->unique(['role_id', 'module_id'], 'uq_role_module');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
