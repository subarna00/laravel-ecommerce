<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Ad;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Subarna Uprety',
            'email' => 'subarnauprety@gmail.com',
        ]);
        Banner::factory(10)->create();
        // Ad::factory(10)->create();
        Brand::factory(10)->create();
        Partner::factory(10)->create();
    }
}
