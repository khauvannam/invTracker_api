<?php

namespace Database\Factories\Tags;

use App\Models\Tags\Tag;
use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagRelationshipFactory extends Factory
{
    protected $model = \App\Models\Tags\TagRelationship::class;

    public function definition(): array
    {
        return [
            'tag_id' => Tag::inRandomOrder()->first()->id ?? null,
            'folder_id' => Folder::inRandomOrder()->first()->id ?? null,
        ];
    }
}
