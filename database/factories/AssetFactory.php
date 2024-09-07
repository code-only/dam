<?php

namespace Database\Factories;

use App\Enums\AssetType;
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
        $filetypes = ["csv", "png", "gif", "mp4", "txt", "xml"];
        $fileType = array_rand($filetypes);
        return [
            'filename' => fake()->domainName(),
            'filepath' => fake()->filePath() . "." . $filetypes[$fileType],
            'is_private' => fake()->boolean(),
            'user_id' => User::factory(),
            'status' => fake()->boolean,
            'asset_type' => AssetType::detect($filetypes[$fileType]),
            'file_type' => $filetypes[$fileType]
        ];
    }
}
