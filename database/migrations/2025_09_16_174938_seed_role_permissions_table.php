<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $roles = DB::table('user_roles')->pluck('id','role_code');
        $modules = DB::table('system_modules')->pluck('id','module_code');

        $permissions = [];

        // ----------------------------
        // Superadmin: Full access
        // ----------------------------
        foreach ($modules as $code => $id) {
            $permissions[] = [
                'role_id' => $roles[1],
                'module_id' => $id,
                'can_view' => 1,
                'can_create' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // ----------------------------
        // Store Admin: Full access
        // ----------------------------
        foreach ($modules as $code => $id) {
            $permissions[] = [
                'role_id' => $roles[4],
                'module_id' => $id,
                'can_view' => 1,
                'can_create' => 1,
                'can_update' => 1,
                'can_delete' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // ----------------------------
        // Store Manager: Sales, Purchase, Inventory, Expense
        // ----------------------------
        $manager_modules = [
            'sales_invoice', 'sales_payment_in', 'sales_return', 'sales_quotation', 'sales_order',
            'purchase_bills', 'purchase_payment_out', 'purchase_return', 'purchase_order',
            'inventory_item_management', 'inventory_stock_management',
            'expense_expenses', 'expense_category'
        ];

        foreach ($manager_modules as $code) {
            $permissions[] = [
                'role_id' => $roles[5],
                'module_id' => $modules[$code],
                'can_view' => 1,
                'can_create' => 1,
                'can_update' => 1,
                'can_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // ----------------------------
        // Store Accountant: View + Create/Update for Finance only
        // ----------------------------
        $accountant_modules = [
            'sales_invoice', 'sales_payment_in', 'purchase_bills', 'purchase_payment_out', 'expense_expenses'
        ];

        foreach ($accountant_modules as $code) {
            $permissions[] = [
                'role_id' => $roles[6],
                'module_id' => $modules[$code],
                'can_view' => 1,
                'can_create' => 1,
                'can_update' => 1,
                'can_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // ----------------------------
        // Store Staff: Mostly view-only
        // ----------------------------
        $staff_modules = [
            'sales_invoice', 'sales_payment_in', 'sales_return',
            'purchase_bills', 'purchase_payment_out', 'purchase_return',
            'inventory_item_management', 'inventory_stock_management',
            'expense_expenses'
        ];

        foreach ($staff_modules as $code) {
            $permissions[] = [
                'role_id' => $roles[7],
                'module_id' => $modules[$code],
                'can_view' => 1,
                'can_create' => 0,
                'can_update' => 0,
                'can_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert all permissions at once
        DB::table('role_permissions')->insert($permissions);
    }

    public function down(): void
    {
        DB::table('role_permissions')->truncate();
    }
};
