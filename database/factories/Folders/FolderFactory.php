<?php

namespace Database\Factories\Folders;

use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

class FolderFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'inventory_id' => 1,
        ];
    }

    public function withChildren(): self
    {
        return $this->afterCreating(function (Folder $folder) {
            Folder::factory()->count(5)->create(['parent_id' => $folder->id]);
        });
    }
}
