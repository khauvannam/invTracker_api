<?php

namespace Database\Seeders;

use App\Models\Folders\Folder;
use App\Models\Histories\UserHistory;
use App\Models\Items\Item;
use App\Models\Items\ItemRelationship;
use App\Models\User;
use App\Models\Field\CustomField;
use App\Models\Field\CustomFieldRelationship;
use App\Models\Tags\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create();  
        Folder::factory()->withChildren()->create();  
        $items = Item::factory()->count(10)->create();
        $tags = Tag::factory()->count(5)->create();
        UserHistory::factory()->create();

        $customFields = CustomField::factory()->count(5)->create(); 
        $customFields->each(function ($customField) use ($items) {
            CustomFieldRelationship::factory()->count(2)->create([  
                'custom_field_id' => $customField->id,
                'item_id' => $items->random()->id, 
            ]);
        });
        $items->each(function ($item) use ($tags) {
            $tags->each(function ($tag) use ($item) {
                // Kiểm tra nếu cặp item_id và tag_id chưa tồn tại
                if (!ItemRelationship::where('item_id', $item->id)->where('tag_id', $tag->id)->exists()) {
                    ItemRelationship::create([
                        'item_id' => $item->id,
                        'tag_id' => $tag->id,
                    ]);
                }
            });
        });
    }
}
