<?php

namespace Tests\Feature\Tag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tags\Tag;

class TagControllerTest extends TestCase
{
    use RefreshDatabase; // Tự động làm sạch database sau mỗi test
    use WithFaker;

    protected $tag;

    protected function setUp(): void
    {
        parent::setUp();

        // Tạo một tag giả để sử dụng trong các test
        $this->tag = Tag::factory()->create();
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
        $response = $this->getJson("/api/tags/{$this->tag->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $this->tag->id,
                     'name' => $this->tag->name,
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
        $data = ['name' => $this->faker->word];

        $response = $this->putJson("/api/tags/{$this->tag->id}", $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $this->tag->id,
                     'name' => $data['name'],
                 ]);

        $this->assertDatabaseHas('tags', $data);
    }

    #[\PHPUnit\Framework\Attributes\Test]
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
