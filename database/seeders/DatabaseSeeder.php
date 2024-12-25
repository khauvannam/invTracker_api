<?php

namespace Database\Seeders;

use App\Models\Folders\Folder;
use App\Models\Items\Item;  
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create();
        Folder::factory()->withChildren()->create();
        Item::factory()->count(10)->create();

    }
}
