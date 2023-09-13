<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Ad;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Dimension;
use App\Models\Image;
use App\Models\Partner;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        SiteSetting::create([
            "name" => "My Ecommerce",
            "logo" => fake()->image('public/images', 200, '200', null, false),
            "favicon" => fake()->image('public/images', 200, '200', null, false),
            "qr" => fake()->image('public/images', 200, '200', null, false),
            "digital_s" => fake()->image('public/images', 200, '200', null, false),
            "email" => "myecommerce@myecommerce.com",
            "number" => "+977 9812345678",
            "address" => "My Address",
            "map" => "map",
            "facebook" => "https://www.facebook.com",
            "youtube" => "https://www.youtube.com",
            "instagram" => "https://www.instagram.com",
            "tiktok" => "https://www.tiktok.com",
            "bill_text"=> fake()->sentence(10),
        ]);
        User::factory()->create([
            'name' => 'Subarna Uprety',
            'email' => 'subarnauprety@gmail.com',
            'type' => 'admin',
            'address' => "ratopul",
            'phone_number' => "9860133122",
        ]);

        Banner::factory(10)->create();
        Ad::factory(10)->create();
        Brand::factory(10)->create();
        Partner::factory(10)->create();
        // create category
        foreach (["Car", "Moter Cycle", "Bus", "Sports", "Books", "House", "Laptops", "Mobiles", "Bat", "Housing"] as $key => $cat) {
            Category::create([
                "title" => $cat,
                "slug" => Str::slug($cat),
                "image" => fake()->image('public/images', 200, '200', null, false),
                "icon" => fake()->randomElement(['<i class="ri-git-repository-fill"></i>', '<i class="ri-bookmark-line"></i>', '<i class="ri-car-line"></i>', '<i class="ri-bear-smile-line"></i>', '<i class="ri-bell-line"></i>', '<i class="ri-caravan-line"></i>', '<i class="ri-mastercard-line"></i>', '<i class="ri-empathize-line"></i>']),
            ]);
        }

        // create sub category
        foreach (["Ca", "Moter", "Bu-s", "Spo", "Bo", "Hou", "Lap", "biles", "Bat", "Hous"] as $key => $cat) {
            SubCategory::create([
                "title" => $cat,
                "slug" => Str::slug($cat),
                'category_id' => $key + 1,
                "image" => fake()->image('public/images', 200, '200', null, false)
            ]);
        }
        Product::factory(100)->create();
        Size::factory(100)->create();
        Color::factory(100)->create();
        Dimension::factory(100)->create();
        Image::factory(200)->create();
    }
}
