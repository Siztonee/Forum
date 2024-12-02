<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 1;

        $names = [
            'Код ревью',
            'Помощь с кодом',
            'Задачи',
            'ПК и Девайсы',
            'Web разработка',
            'Mob разработка',
            'Разработка ПО',
            'DevOps',
            'Операционные системы',
            'Data Science'
        ];

        $icons = [
            'fa-code',
            'fa-info',
            'fa-brain',
            'fa-computer',
            'fa-w',
            'fa-mobile',
            'fa-desktop',
            'fa-server',
            'fa-star',
            'fa-d'
        ];

        if ($counter > count($names)) {
            throw new \Exception('Not enough names or icons in the arrays.');
        }

        $creator = User::where('role', 'admin')->first();
        if (!$creator) {
            throw new \Exception('Admin user not found. Please create an admin user.');
        }

        $name = $names[$counter - 1];
        $icon = $icons[$counter - 1];
        $slug = Str::slug($name);

        $counter++;

        return [
            'creator_id' => $creator->id,
            'name' => $name,
            'icon' => $icon,
            'bg_color' => '#000',
            'slug' => $slug,
        ];
    }

}
