<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Insert old user_level data into new user_roles table
        DB::table('user_roles')->insert([
            ['role_name' => 'Superadmin',       'role_code' => '1',  'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Manager',          'role_code' => '2',  'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Staff',            'role_code' => '3',  'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Store Admin',      'role_code' => '4',  'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Store Manager',    'role_code' => '5',  'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Store Accountant', 'role_code' => '6',  'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Store Staff',      'role_code' => '7',  'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Biller',           'role_code' => '8',  'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Executive',        'role_code' => '9',  'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Customer',         'role_code' => '10', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'Reseller',         'role_code' => '11', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        // Delete the inserted roles if the migration is rolled back
        DB::table('user_roles')->whereIn('role_code', ['1','2','3','4','5','6','7','8','9','10','11'])->delete();
    }
};
