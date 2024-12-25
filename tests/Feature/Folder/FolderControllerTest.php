<?php

namespace Folder;

use App\Models\Folders\Folder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FolderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_folders()
    {
        Folder::factory()->count(3)->create();

        $response = $this->getJson(route('folders.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_create_a_new_folder()
    {
        $data = [
            'name' => 'New Folder',
            'description' => 'A test folder description.',
        ];

        $response = $this->postJson(route('folders.store'), $data);

        $response->assertStatus(201)
            ->assertJsonFragment($data);

        $this->assertDatabaseHas('folders', $data);
    }

    /** @test */
    public function it_can_show_a_single_folder()
    {
        $folder = Folder::factory()->create();

        $response = $this->getJson(route('folders.show', $folder));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $folder->id,
                'name' => $folder->name,
            ]);
    }

    /** @test */
    public function it_can_update_a_folder()
    {
        $folder = Folder::factory()->create();

        $updatedData = [
            'name' => 'Updated Folder',
            'description' => 'Updated description.',
        ];

        $response = $this->putJson(route('folders.update', $folder), $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('folders', $updatedData);
    }

    /** @test */
    public function it_can_delete_a_folder()
    {
        $folder = Folder::factory()->create();

        $response = $this->deleteJson(route('folders.destroy', $folder));

        $response->assertStatus(200);

        $this->assertDatabaseMissing('folders', ['id' => $folder->id]);
    }
}
