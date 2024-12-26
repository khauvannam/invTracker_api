<?php

namespace Tests\Controller;

use App\Models\Tags\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;


    use WithFaker;

    protected Tag $tag;

    protected function setUp(): void
    {
        parent::setUp();

        // Tạo một tag giả để sử dụng trong các test
        $this->tag = Tag::factory()->create();
    }

    #[Test]
    public function it_can_get_all_tags()
    {
        $response = $this->getJson('/api/tags');

        $response->assertStatus(200)
            ->assertJsonStructure([['id', 'name', 'created_at', 'updated_at']]);
    }

    #[Test]
    public function it_can_get_a_single_tag()
    {
        $response = $this->getJson("/api/tags/{$this->tag->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $this->tag->id,
                'name' => $this->tag->name,
            ]);
    }

    #[Test]
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

    #[Test]
    public function it_can_update_a_tag()
    {
        $data = ['name' => $this->faker->word];

        $response = $this->putJson("/api/tags/{$this->tag->id}", $data);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $this->tag->id,
                'name' => $data['name'],
            ]);

        $this->assertDatabaseHas('tags', $data);
    }

    #[Test]
    public function it_can_delete_a_tag()
    {
        $response = $this->deleteJson("/api/tags/{$this->tag->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Tag deleted successfully',
            ]);

        $this->assertDatabaseMissing('tags', ['id' => $this->tag->id]);
    }
}
