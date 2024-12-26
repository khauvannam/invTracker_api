<?php

namespace Database\Factories\Items;

use App\Models\Items\Item;
use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,  
            'quantity' => $this->faker->numberBetween(1, 100),  
            'alert' => $this->faker->numberBetween(1, 10),  
            'price' => $this->faker->randomFloat(2, 10, 1000),  
            'images' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl()]),  
            'notes' => $this->faker->sentence,  
            'folder_id' => Folder::factory(), 
        ];
    }
}
