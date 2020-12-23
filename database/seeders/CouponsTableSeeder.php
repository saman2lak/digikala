<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code'=>'111',
            'type'=>'fixed',
            'value'=>'1000',
        ]);
        Coupon::create([
            'code'=>'222',
            'type'=>'percent_off',
            'percent_off'=>'50',
        ]);
    }
}