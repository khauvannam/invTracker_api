<?php

namespace Database\Factories\Tags;

use Illuminate\Database\Eloquent\Factories\Factory;
// use App\Models\Item;
use App\Models\Folders\Folder;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), // Random name for the tag
            // 'items_id' => Item::inRandomOrder()->first()->id ?? null, 
        ];
    }
}
