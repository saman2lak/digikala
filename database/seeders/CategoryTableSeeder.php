<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class MyCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=>'کالای دیجیتال',
            'slug'=>'digital-devices',
        ]);
        Category::create([
            'name'=>'آرایشی و بهداشتی',
            'slug'=>'beauty-products',
        ]);
        Category::create([
            'name'=>'خودرو',
            'slug'=>'car-product',
        ]);
        Category::create([
            'name'=>'پوشاک',
            'slug'=>'shirt-product',
        ]);
        Category::create([
            'name'=>'سوپرمارکت',
            'slug'=>'market-product',
        ]);
        Category::create([
            'name'=>'لوازم ساختمان',
            'slug'=>'apartment-product',
        ]);
        Category::create([
            'name'=>'لوازم خانگی',
            'slug'=>'home-product',
        ]);
    }
}
