<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use CategoriesTableSeeder;
use DataRowsTableSeeder;
use DataTypesTableSeeder;
use Illuminate\Database\Seeder;
use MenuItemsTableSeeder;
use PagesTableSeeder;
use PermissionRoleTableSeeder;
use PermissionsTableSeeder;
use PostsTableSeeder;
use RolesTableSeeder;
use SettingsTableSeeder;
use TranslationsTableSeeder;
use UsersTableSeeder;
use VoyagerDatabaseSeeder;
use VoyagerDummyDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Product::factory(10)->create();
        // Category::factory(10)->create();
        $this->call(MyCategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(FeatureTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
    }
}