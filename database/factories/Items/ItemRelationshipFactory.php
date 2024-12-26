<?php

namespace Database\Factories\Items;

use App\Models\Items\ItemRelationship;
use App\Models\Items\Item;
use App\Models\Tags\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemRelationshipFactory extends Factory
{
    protected $model = ItemRelationship::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_id' => Item::factory(), // Tạo một Item mới
            'tag_id' => Tag::factory(),   // Tạo một Tag mới
        ];
    }
}
