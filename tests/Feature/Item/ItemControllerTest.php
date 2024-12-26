<?php

namespace Tests\Feature\Item;

use App\Models\Items\Item;
use App\Models\Tags\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_store_item()
{
    $folder = \App\Models\Folders\Folder::factory()->create(); 

    $data = [
        'name' => 'Item 1',
        'quantity' => 10,
        'alert' => 5,
        'price' => 100,
        'folder_id' => $folder->id, 
        'images' => ['image1.jpg'],
        'notes' => 'Item notes',
    ];

    $response = $this->postJson('/api/items', $data);

    $response->assertStatus(201);
    $response->assertJson([
        'name' => 'Item 1',
        'quantity' => 10,
    ]);
}

   
    public function test_index_items()
    {
        Item::factory()->count(3)->create();

        $response = $this->getJson('/api/items');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

   
    public function test_show_item()
    {
        $item = Item::factory()->create();

        $response = $this->getJson("/api/items/{$item->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $item->id,
            'name' => $item->name,
        ]);
    }

   
    public function test_update_item()
    {
        $item = Item::factory()->create();
        $data = [
            'name' => 'Updated Item',
            'quantity' => 20,
        ];

        $response = $this->putJson("/api/items/{$item->id}", $data);

        $response->assertStatus(200);
        $response->assertJson([
            'name' => 'Updated Item',
            'quantity' => 20,
        ]);
    }


    public function test_delete_item()
    {
        $item = Item::factory()->create();

        $response = $this->deleteJson("/api/items/{$item->id}");

        $response->assertStatus(204);
    }

    
    public function test_add_relationship_to_item()
    {
        $item = Item::factory()->create();
        $tag = Tag::factory()->create(); 

        $data = [
            'tag_id' => $tag->id,
        ];

        $response = $this->postJson("/api/items/{$item->id}/relationships", $data);

        $response->assertStatus(201);
        $response->assertJson([
            'tag_id' => $tag->id,
        ]);
    }

    
    public function test_get_relationships_of_item()
    {
        $item = Item::factory()->create();
        $tag = Tag::factory()->create();

        
        $item->tags()->attach($tag);

        $response = $this->getJson("/api/items/{$item->id}/relationships");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'tag_id' => $tag->id,
        ]);
    }

    public function test_remove_relationship_of_item()
    {
        $item = Item::factory()->create();
        $tag = Tag::factory()->create();
        $item->tags()->attach($tag);

        $response = $this->deleteJson("/api/items/{$item->id}/relationships/{$tag->id}");

        $response->assertStatus(204);
    }
}
