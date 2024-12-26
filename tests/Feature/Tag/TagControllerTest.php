<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Tag\TagService;
use App\Models\Tags\Tag;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $tagService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tagService = app(TagService::class); // Inject TagService

        // Tạo một tag giả để sử dụng trong các test
        $this->tagService->createTag(['name' => 'Test Tag']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_get_all_tags()
    {
        $response = $this->getJson('/api/tags');

        $response->assertStatus(200)
                 ->assertJsonStructure([['id', 'name', 'created_at', 'updated_at']]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_get_a_single_tag()
    {
        $tag = $this->tagService->getAllTags()->first();

        $response = $this->getJson("/api/tags/{$tag->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $tag->id,
                     'name' => $tag->name,
                 ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_create_a_tag()
    {
        $data = ['name' => $this->faker->word];

        $response = $this->postJson('/api/tags', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'name' => $data['name'],
                 ]);

        $this->assertDatabaseHas('tags', $data);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_a_tag()
    {
        $tag = $this->tagService->getAllTags()->first();

        $data = ['name' => $this->faker->word];

        $response = $this->putJson("/api/tags/{$tag->id}", $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $tag->id,
                     'name' => $data['name'],
                 ]);

        $this->assertDatabaseHas('tags', $data);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_a_tag()
    {
        $tag = $this->tagService->getAllTags()->first();

        $response = $this->deleteJson("/api/tags/{$tag->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Tag deleted successfully',
                 ]);

        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }
}
