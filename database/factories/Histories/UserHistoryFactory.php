<?php

namespace Database\Factories\Histories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Folders\Folder;
use  App\Models\Items\Item;
use App\Models\User;


class UserHistoryFactory extends Factory
{

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first(), 
            'activity_type' => $this->faker->randomElement(['create', 'update', 'delete','move']),
            'folder_id'=> Folder::inRandomOrder()->first(),
            'item_id'=> Item::inRandomOrder()->first(),
        ];
    }
}
