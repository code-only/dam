<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'filename' => fake()->name(),
            'filepath' => fake()->filePath(),
            'thumbnail' => fake()->imageUrl(),
            'is_private' => fake()->boolean(),
            'user_id' => User::factory(),
            'asset_type' => fake()->randomElement(["image", "video", "document"])
        ];
    }
}
