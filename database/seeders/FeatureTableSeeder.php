<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feature::create([
            'name' => 'درگاه ارتباطی',
            'value' => 'usb 3',
            'product_id' => '1',
        ]);
        Feature::create([
            'name' => 'امکان شارژ سریع',
            'value' => 'دارد',
            'product_id' => '1',
        ]);
        Feature::create([
            'name' => 'محدوده ظرفیت',
            'value' => '10 تا 15 هزار میلی آمپر ساعت',
            'product_id' => '1',
        ]);
        Feature::create([
            'name' => 'شدت جریان خروجی',
            'value' => '2 آمپر',
            'product_id' => '1',
        ]);
    }
}
