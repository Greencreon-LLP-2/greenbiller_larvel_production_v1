<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = Carbon::now();

        // ----------------------------
        // Business Types
        // ----------------------------
        $businessTypes = [
            'Retail Store',
            'Grocery Shop',
            'Restaurant',
            'Cafe',
            'Pharmacy',
            'Clothing Store',
            'Electronics Shop',
            'Hardware Shop',
            'Beauty Salon',
            'Online Store',
            'Medium Enterprise',
            'Bakery',
            'Juice Bar',
            'Furniture Shop',
            'Stationery Store',
            'Mobile Accessories Shop',
            'Pet Shop',
            'Toy Store',
            'Gift Shop',
            'Bookstore',
            'Flower Shop',
            'Car Repair Workshop',
            'Photo Studio',
            'Travel Agency',
            'Fitness Center',
            'Yoga Studio',
            'Printing Services',
            'Cyber Cafe',
            'Music Shop',
            'Home Decor Store',
        ];

        foreach ($businessTypes as $type) {
            DB::table('business_types')->insert([
                'name' => $type,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // ----------------------------
        // Business Categories
        // ----------------------------
        $businessCategories = [
            'Food & Beverages',
            'Retail',
            'Health & Pharmacy',
            'Electronics',
            'Fashion & Apparel',
            'Beauty & Wellness',
            'Education',
            'Services',
            'Wholesale',
            'Online Business',
            'Home & Living',
            'Automotive',
            'Entertainment',
            'Travel & Tourism',
            'Sports & Fitness',
            'Professional Services',
            'IT & Software',
            'Finance & Accounting',
            'Media & Advertising',
            'Construction & Hardware',
            'Stationery & Office Supplies',
            'Arts & Crafts',
            'Photography',
            'Pet & Animal Care',
            'Event Management',
            'Jewelry & Accessories',
            'Furniture & Decor',
            'Bakery & Confectionery',
            'Telecom & Mobile',
            'Printing & Packaging',
        ];
        foreach ($businessCategories as $category) {
            DB::table('business_categories')->insert([
                'name' => $category,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // ----------------------------
        // Languages
        // ----------------------------
        $languages = [
            ['English', 'en'],
            ['Hindi', 'hi'],
            ['Bengali', 'bn'],
            ['Telugu', 'te'],
            ['Marathi', 'mr'],
            ['Tamil', 'ta'],
            ['Urdu', 'ur'],
            ['Gujarati', 'gu'],
            ['Kannada', 'kn'],
            ['Odia', 'or'],
            ['Malayalam', 'ml'],
            ['Punjabi', 'pa'],
            ['Assamese', 'as'],
            ['Maithili', 'mai'],
            ['Arabic', 'ar'], // for UAE/Arabic region
        ];

        foreach ($languages as $lang) {
            DB::table('languages')->insert([
                'name' => $lang[0],
                'code' => $lang[1],
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // ----------------------------
        // Currencies
        // ----------------------------
        $currencies = [
            ['INR', 'Indian Rupee', '₹'],
            ['USD', 'US Dollar', '$'],
            ['AED', 'UAE Dirham', 'د.إ'],
            ['SAR', 'Saudi Riyal', 'ر.س'],
            ['KWD', 'Kuwaiti Dinar', 'د.ك'],
        ];

        foreach ($currencies as $curr) {
            DB::table('currencies')->insert([
                'code' => $curr[0],
                'name' => $curr[1],
                'symbol' => $curr[2],
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        DB::table('business_types')->truncate();
        DB::table('business_categories')->truncate();
        DB::table('languages')->truncate();
        DB::table('currencies')->truncate();
    }
};
