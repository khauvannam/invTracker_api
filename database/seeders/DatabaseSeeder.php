<?php

namespace Database\Seeders;

use App\Models\Folders\Folder;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Tags\Tag;
use Database\Factories\Tags\TagFactory;  


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
        Tag::factory()->count(10)->create();
    }
}
