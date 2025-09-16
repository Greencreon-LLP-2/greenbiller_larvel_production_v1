<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $now = Carbon::now();

        // ----------------------------
        // Units
        // ----------------------------
        $units = [
            ['name' => 'Kilogram', 'symbol' => 'kg', 'description' => 'Weight unit'],
            ['name' => 'Gram', 'symbol' => 'g', 'description' => 'Weight unit'],
            ['name' => 'Liter', 'symbol' => 'L', 'description' => 'Volume unit'],
            ['name' => 'Milliliter', 'symbol' => 'ml', 'description' => 'Volume unit'],
            ['name' => 'Piece', 'symbol' => 'pc', 'description' => 'Piece unit'],
            ['name' => 'Dozen', 'symbol' => 'dz', 'description' => '12 pieces'],
        ];

        foreach ($units as $unit) {
            DB::table('units')->insert([
                'name' => $unit['name'],
                'symbol' => $unit['symbol'],
                'description' => $unit['description'],
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $unitIds = DB::table('units')->pluck('id', 'name')->toArray();

        // ----------------------------
        // Unit Conversions
        // ----------------------------
        $unitConversions = [
            ['base' => 'Kilogram', 'sub' => 'Gram', 'factor' => 1000, 'note' => '1 kg = 1000 g'],
            ['base' => 'Liter', 'sub' => 'Milliliter', 'factor' => 1000, 'note' => '1 L = 1000 ml'],
            ['base' => 'Dozen', 'sub' => 'Piece', 'factor' => 12, 'note' => '1 dozen = 12 pieces'],
        ];

        foreach ($unitConversions as $conv) {
            DB::table('unit_conversions')->insert([
                'base_unit_id' => $unitIds[$conv['base']],
                'sub_unit_id' => $unitIds[$conv['sub']],
                'factor' => $conv['factor'],
                'note' => $conv['note'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // ----------------------------
        // Taxes
        // ----------------------------
        $gstId = DB::table('taxes')->insertGetId([
            'tax_type' => 'GST',
            'parent_id' => null,
            'name' => 'GST India',
            'rate' => 0,
            'group_type' => 'NONE',
            'status' => 'active',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $gstChildren = [
            ['name' => 'CGST', 'rate' => 9, 'group_type' => 'CGST'],
            ['name' => 'SGST', 'rate' => 9, 'group_type' => 'SGST'],
            ['name' => 'IGST', 'rate' => 18, 'group_type' => 'IGST'],
        ];

        foreach ($gstChildren as $child) {
            DB::table('taxes')->insert([
                'tax_type' => 'GST',
                'parent_id' => $gstId,
                'name' => $child['name'],
                'rate' => $child['rate'],
                'group_type' => $child['group_type'],
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // UAE VAT
        DB::table('taxes')->insert([
            'tax_type' => 'VAT',
            'parent_id' => null,
            'name' => 'VAT UAE',
            'rate' => 5,
            'group_type' => 'NONE',
            'status' => 'active',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Universal / Other Taxes
        DB::table('taxes')->insert([
            'tax_type' => 'OTHER',
            'parent_id' => null,
            'name' => 'Service Tax',
            'rate' => 10,
            'group_type' => 'NONE',
            'status' => 'active',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // ----------------------------
        // Payment Types
        // ----------------------------
        $payments = [
            ['name' => 'Cash', 'description' => 'Cash Payment'],
            ['name' => 'UPI', 'description' => 'Unified Payments Interface'],
            ['name' => 'Credit Card', 'description' => 'Visa, MasterCard, etc.'],
            ['name' => 'Debit Card', 'description' => 'Bank debit cards'],
            ['name' => 'Net Banking', 'description' => 'Internet Banking'],
            ['name' => 'Wallet', 'description' => 'Digital Wallets like Paytm, PhonePe'],
            ['name' => 'Cheque', 'description' => 'Bank Cheque Payment'],
            ['name' => 'Bank Transfer', 'description' => 'Direct bank transfer'],
        ];

        foreach ($payments as $p) {
            DB::table('payment_types')->insert([
                'name' => $p['name'],
                'description' => $p['description'],
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('unit_conversions')->truncate();
        DB::table('units')->truncate();
        DB::table('taxes')->truncate();
        DB::table('payment_types')->truncate();
    }
};
