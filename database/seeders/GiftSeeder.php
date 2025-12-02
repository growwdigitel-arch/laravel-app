<?php

namespace Database\Seeders;

use App\Models\Gift;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GiftSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gifts')->truncate();

        $gifts = [
            // Small Range (10 - 99 coins)
            ['name' => 'Rose', 'price' => 10, 'image' => '🌹', 'is_featured' => false],
            ['name' => 'Heart', 'price' => 20, 'image' => '❤️', 'is_featured' => false],
            ['name' => 'Chocolate', 'price' => 50, 'image' => '🍫', 'is_featured' => false],
            ['name' => 'Coffee', 'price' => 80, 'image' => '☕', 'is_featured' => false],
            
            // Medium Range (100 - 499 coins)
            ['name' => 'Diamond', 'price' => 100, 'image' => '💎', 'is_featured' => true],
            ['name' => 'Cake', 'price' => 150, 'image' => '🎂', 'is_featured' => false],
            ['name' => 'Ring', 'price' => 200, 'image' => '💍', 'is_featured' => false],
            ['name' => 'Crown', 'price' => 300, 'image' => '👑', 'is_featured' => true],
            ['name' => 'Trophy', 'price' => 400, 'image' => '🏆', 'is_featured' => false],

            // High Range (500 - 1999 coins)
            ['name' => 'Sports Car', 'price' => 500, 'image' => '🏎️', 'is_featured' => true],
            ['name' => 'Yacht', 'price' => 800, 'image' => '🛥️', 'is_featured' => false],
            ['name' => 'Rocket', 'price' => 1000, 'image' => '🚀', 'is_featured' => true],
            ['name' => 'Castle', 'price' => 1500, 'image' => '🏰', 'is_featured' => true],

            // Ultra High Range (2000+ coins)
            ['name' => 'Dragon', 'price' => 2500, 'image' => '🐉', 'is_featured' => true],
            ['name' => 'Phoenix', 'price' => 3000, 'image' => '🦅', 'is_featured' => true],
            ['name' => 'Planet', 'price' => 5000, 'image' => '🪐', 'is_featured' => true],
        ];

        foreach ($gifts as $gift) {
            Gift::create($gift);
        }
    }
}
