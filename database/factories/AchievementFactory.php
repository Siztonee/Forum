<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    protected $model = Achievement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $iconsCounter = 1;

        $achievements = [
            'Master of Code',
            'Debugging Ninja',
            'Laravel Guru',
            'PHP Artisan',
            'Database Wizard',
            'Frontend Hero',
            'Backend Architect',
            'Full-Stack Star',
            'API Innovator',
            'DevOps Mastermind'
        ];

        $name = $achievements[$iconsCounter - 1]; 
        $icon = "resources/achievements/{$iconsCounter}.jpg";

        $iconsCounter++;

        return [
            'name' => $name,
            'icon' => $icon,
        ];
    }
}
