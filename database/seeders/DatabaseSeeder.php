<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Topic;
use App\Models\Message;
use App\Models\Category;
use App\Models\Achievement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create();
        // Category::factory()->count(10)->create();
        // Topic::factory()->count(10)->create();
        Message::factory()->count(10)->create();
        Achievement::factory()->count(10)->create();
    }
}
