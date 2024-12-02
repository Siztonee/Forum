<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $category_id = 1;  

        $name = $this->faker->words(3, true); 

        $data = [
            'creator_id' => 1,
            'category_id' => $category_id,
            'name' => $name,
            'slug' => Str::slug($name),
        ];

        $category_id++; 

        return $data;
    }
}
