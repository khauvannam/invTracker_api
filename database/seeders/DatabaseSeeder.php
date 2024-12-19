<?php

namespace Database\Seeders;

use App\Models\Folders\folder;
use App\Models\Items\Item;
use App\Models\Tags\Tag;
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

        User::factory()->create();

        Folder::factory()->withChildren()->create();

        Tag::factory()->count(10)->create();

        Item::factory()->count(10)->create();

    }
}
