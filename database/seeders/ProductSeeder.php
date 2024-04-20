<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example: Insert a user into the 'users' table
        Product::create([
            'slug' => 'slug',
                'regular_price' => 'regular_price',
                'SKU' => 'SKU',
                'stock_status' => 'stock_status',
                'quantity' => 'quantity',
                'category_id' => 'category_id',
                'featured' => 'featured', false,
                'image' => 'image',


                'en' => [
                    'name' => 'name_en',
                    'short_description_en' => 'short_description_en',
                    'description_en' => 'description_en',
                ],
                'ar' => [
                    'name' => 'name_ar',
                    'short_description_ar' => 'short_description_ar',
                    'description_ar' => 'description_ar',
                ],
        ]);

        // Add more seeding logic as needed
    }
}
