<?php

namespace Tests\Feature\Field;

use App\Models\Field\CustomField;
use App\Models\Items\Item;  
use App\Models\Folders\Folder;  
use App\Services\Field\CustomFieldService;
use App\Services\Field\CustomFieldRelationshipService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CustomFieldControllerTest extends TestCase
{
    use RefreshDatabase;

    protected CustomFieldService $customFieldService;
    protected CustomFieldRelationshipService $customFieldRelationshipService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customFieldService = app(CustomFieldService::class);
        $this->customFieldRelationshipService = app(CustomFieldRelationshipService::class);
    }

    public function test_store_custom_field()
    {
        $data = [
            'name' => 'Custom Field 1',
            'type' => 'text',
            'placeholder' => 'Enter text',
            'default_value' => 'Default text',
            'applies_to_items' => true,
            'applies_to_folders' => false,
        ];

        $customField = $this->customFieldService->create($data);

        $response = $this->postJson('/api/fields/custom-fields', $data);

        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJson([
                     'name' => 'Custom Field 1',
                     'type' => 'text',
                 ]);

        $this->assertDatabaseHas('custom_fields', $data);
    }
    public function test_index_custom_fields()
    {
        $customFields = CustomField::factory()->count(3)->create();

        $response = $this->getJson('/api/fields/custom-fields');

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonCount(3); 
    }

    public function test_show_custom_field()
    {
        $customField = CustomField::factory()->create();

        $response = $this->getJson("/api/fields/custom-fields/{$customField->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $customField->id,
                     'name' => $customField->name,
                 ]);
    }

    public function test_update_custom_field()
    {
        $customField = CustomField::factory()->create();

        $data = [
            'name' => 'Updated Custom Field',
            'type' => 'number',
            'placeholder' => 'Enter number',
            'default_value' => '0',
            'applies_to_items' => false,
            'applies_to_folders' => true,
        ];

        $response = $this->putJson("/api/fields/custom-fields/{$customField->id}", $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'name' => 'Updated Custom Field',
                     'type' => 'number',
                 ]);

        $this->assertDatabaseHas('custom_fields', [
            'id' => $customField->id,
            'name' => 'Updated Custom Field',
            'type' => 'number',
        ]);
    }

    public function test_delete_custom_field()
    {
        $customField = CustomField::factory()->create();

        $response = $this->deleteJson("/api/fields/custom-fields/{$customField->id}");

        $response->assertStatus(204);


        $this->assertDatabaseMissing('custom_fields', [
            'id' => $customField->id,
        ]);
    }


    public function test_add_relationship()
    {
        $customField = CustomField::factory()->create();
        $item = Item::factory()->create(); 
        $folder = Folder::factory()->create(); 

        $data = [
            'item_id' => $item->id,  
            'folder_id' => $folder->id,  
            'value' => 'Relationship value',
        ];

        
        $relationship = $this->customFieldRelationshipService->createRelationship($customField->id, $data);

        
        $response = $this->postJson("/api/fields/custom-fields/{$customField->id}/relationships", $data);

       
        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJson($data);
    }

    public function test_get_relationships()
    {
        $customField = CustomField::factory()->create();
        $item = Item::factory()->create(); 
        $folder = Folder::factory()->create(); 

        $relationships = [
            ['item_id' => $item->id, 'folder_id' => $folder->id, 'value' => 'Relationship 1'],
            ['item_id' => $item->id, 'folder_id' => $folder->id, 'value' => 'Relationship 2'],
        ];

        
        foreach ($relationships as $relationship) {
            $this->customFieldRelationshipService->createRelationship($customField->id, $relationship);
        }

        $response = $this->getJson("/api/fields/custom-fields/{$customField->id}/relationships");

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson($relationships);
    }

    public function test_remove_relationship()
    {
        
        $customField = CustomField::factory()->create();
        $item = Item::factory()->create(); 
        $folder = Folder::factory()->create(); 

        
        $relationship = $this->customFieldRelationshipService->createRelationship($customField->id, [
            'item_id' => $item->id,
            'folder_id' => $folder->id,
            'value' => 'Relationship value',
        ]);

        $relationshipId = $relationship->id;

        
        $response = $this->deleteJson("/api/fields/custom-fields/{$customField->id}/relationships/{$relationshipId}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
