<?php

namespace Database\Seeders;

use App\Models\Folders\Folder;
use App\Models\Histories\UserHistory;
use App\Models\Tags\TagRelationship;
use App\Models\Tags\Tag;
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
        UserHistory::factory()->create();
        Tag::factory()->count(10)->create();
        TagRelationship::factory()->count(10)->create();

    }
}
