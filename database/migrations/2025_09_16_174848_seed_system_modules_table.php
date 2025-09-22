<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $modules = [
            // Quick Links
            ['module_name' => 'New Sales', 'module_group' => 'Quick Link', 'module_code' => 'quicklink_new_sales', 'is_pro_feature' => 0],
            ['module_name' => 'New Purchase', 'module_group' => 'Quick Link', 'module_code' => 'quicklink_new_purchase', 'is_pro_feature' => 0],
            ['module_name' => 'POS', 'module_group' => 'Quick Link', 'module_code' => 'quicklink_pos', 'is_pro_feature' => 1],

            // Parties
            ['module_name' => 'Customer', 'module_group' => 'Parties', 'module_code' => 'parties_customer', 'is_pro_feature' => 0],
            ['module_name' => 'Supplier', 'module_group' => 'Parties', 'module_code' => 'parties_supplier', 'is_pro_feature' => 0],

            // My Business - Sales
            ['module_name' => 'Sale Invoice', 'module_group' => 'My Business - Sales', 'module_code' => 'sales_invoice', 'is_pro_feature' => 0],
            ['module_name' => 'Payment-in', 'module_group' => 'My Business - Sales', 'module_code' => 'sales_payment_in', 'is_pro_feature' => 0],
            ['module_name' => 'Sale Return', 'module_group' => 'My Business - Sales', 'module_code' => 'sales_return', 'is_pro_feature' => 0],
            ['module_name' => 'Estimate/Quotation', 'module_group' => 'My Business - Sales', 'module_code' => 'sales_quotation', 'is_pro_feature' => 0],
            ['module_name' => 'Sales Order', 'module_group' => 'My Business - Sales', 'module_code' => 'sales_order', 'is_pro_feature' => 0],

            // My Business - Purchase
            ['module_name' => 'Purchase Bills', 'module_group' => 'My Business - Purchase', 'module_code' => 'purchase_bills', 'is_pro_feature' => 0],
            ['module_name' => 'Payment-out', 'module_group' => 'My Business - Purchase', 'module_code' => 'purchase_payment_out', 'is_pro_feature' => 0],
            ['module_name' => 'Purchase Return', 'module_group' => 'My Business - Purchase', 'module_code' => 'purchase_return', 'is_pro_feature' => 0],
            ['module_name' => 'Purchase Order', 'module_group' => 'My Business - Purchase', 'module_code' => 'purchase_order', 'is_pro_feature' => 0],

            // Inventory
            ['module_name' => 'Item Management', 'module_group' => 'Inventory', 'module_code' => 'inventory_item_management', 'is_pro_feature' => 0],
            ['module_name' => 'Stock Management', 'module_group' => 'Inventory', 'module_code' => 'inventory_stock_management', 'is_pro_feature' => 0],

            // Expense
            ['module_name' => 'Expenses', 'module_group' => 'Expense', 'module_code' => 'expense_expenses', 'is_pro_feature' => 0],
            ['module_name' => 'Expenses Category', 'module_group' => 'Expense', 'module_code' => 'expense_category', 'is_pro_feature' => 0],

            // Report - Transaction
            ['module_name' => 'Sale Report', 'module_group' => 'Report - Transaction', 'module_code' => 'report_sale', 'is_pro_feature' => 0],
            ['module_name' => 'Purchase Report', 'module_group' => 'Report - Transaction', 'module_code' => 'report_purchase', 'is_pro_feature' => 0],
            ['module_name' => 'Day Book', 'module_group' => 'Report - Transaction', 'module_code' => 'report_daybook', 'is_pro_feature' => 1],
            ['module_name' => 'Profit & Loss', 'module_group' => 'Report - Transaction', 'module_code' => 'report_profit_loss', 'is_pro_feature' => 1],
            ['module_name' => 'All Transaction Report', 'module_group' => 'Report - Transaction', 'module_code' => 'report_all_transaction', 'is_pro_feature' => 1],
            ['module_name' => 'Cash-flow', 'module_group' => 'Report - Transaction', 'module_code' => 'report_cashflow', 'is_pro_feature' => 1],
            ['module_name' => 'Balance Sheet', 'module_group' => 'Report - Transaction', 'module_code' => 'report_balance_sheet', 'is_pro_feature' => 1],

            // Party Reports
            ['module_name' => 'Party Statement', 'module_group' => 'Report - Party Reports', 'module_code' => 'report_party_statement', 'is_pro_feature' => 0],
            ['module_name' => 'Party Wise Profit & Loss', 'module_group' => 'Report - Party Reports', 'module_code' => 'report_party_profit_loss', 'is_pro_feature' => 1],
            ['module_name' => 'All Parties Report', 'module_group' => 'Report - Party Reports', 'module_code' => 'report_all_parties', 'is_pro_feature' => 1],

            // Item/Stock Reports
            ['module_name' => 'Stock Summary Report', 'module_group' => 'Report - Item/Stock Reports', 'module_code' => 'report_stock_summary', 'is_pro_feature' => 0],
            ['module_name' => 'Item Wise Profit & Loss', 'module_group' => 'Report - Item/Stock Reports', 'module_code' => 'report_item_profit_loss', 'is_pro_feature' => 1],
            ['module_name' => 'Stock Details Report', 'module_group' => 'Report - Item/Stock Reports', 'module_code' => 'report_stock_details', 'is_pro_feature' => 1],

            // GST Reports
            ['module_name' => 'GSTR-1', 'module_group' => 'Report - GST Reports', 'module_code' => 'report_gstr1', 'is_pro_feature' => 0],

            // Expense Reports
            ['module_name' => 'Expense Transaction Report', 'module_group' => 'Report - Expense Reports', 'module_code' => 'report_expense_transaction', 'is_pro_feature' => 0],

            // Cash & Bank
            ['module_name' => 'Bank Account', 'module_group' => 'Cash & Bank', 'module_code' => 'cashbank_bank', 'is_pro_feature' => 0],
            ['module_name' => 'Cash in Hand', 'module_group' => 'Cash & Bank', 'module_code' => 'cashbank_cash', 'is_pro_feature' => 0],

            // Utilities
            ['module_name' => 'Store Management', 'module_group' => 'Utilities', 'module_code' => 'utilities_store_management', 'is_pro_feature' => 0],
            ['module_name' => 'Close Financial Year', 'module_group' => 'Utilities', 'module_code' => 'utilities_close_financial', 'is_pro_feature' => 1],

            // Settings
            ['module_name' => 'Subscription', 'module_group' => 'Settings - Account Settings', 'module_code' => 'settings_subscription', 'is_pro_feature' => 0],
            ['module_name' => 'Business Profile', 'module_group' => 'Settings - Business Profile', 'module_code' => 'settings_business_profile', 'is_pro_feature' => 0],
            ['module_name' => 'Add User', 'module_group' => 'Settings - User Management', 'module_code' => 'settings_add_user', 'is_pro_feature' => 0],
            ['module_name' => 'User Role Management', 'module_group' => 'Settings - User Management', 'module_code' => 'settings_user_roles', 'is_pro_feature' => 1],
            ['module_name' => 'Invoice Settings', 'module_group' => 'Settings - Store Settings', 'module_code' => 'settings_invoice', 'is_pro_feature' => 0],
            ['module_name' => 'Purchase Settings', 'module_group' => 'Settings - Store Settings', 'module_code' => 'settings_purchase', 'is_pro_feature' => 0],
            ['module_name' => 'POS Settings', 'module_group' => 'Settings - Store Settings', 'module_code' => 'settings_pos', 'is_pro_feature' => 1],
        ];

        DB::table('system_modules')->insert($modules);
    }

    public function down(): void
    {
        DB::table('system_modules')->truncate();
    }
};
