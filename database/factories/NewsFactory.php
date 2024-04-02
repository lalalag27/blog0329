<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //建立假資料
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(),
            'pic' => $this->faker->imageUrl(), // 使用 Faker 的 imageUrl 方法,
            'body' => $this->faker->paragraph(5),
        ];
    }
}
