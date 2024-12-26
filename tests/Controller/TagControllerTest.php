<?php

namespace Tests\Controller;

use App\Http\Controllers\Tag\TagController;
use App\Models\Tags\Tag;
use App\Services\TagService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected TagService $tagService;
    protected TagController $tagController;

    protected function setUp(): void
    {
        parent::setUp();

        // Sử dụng TagService thực tế
        $this->tagService = app(TagService::class);

        // Khởi tạo TagController với TagService
        $this->tagController = new TagController($this->tagService);
    }

    public function testIndex()
    {
        // Tạo dữ liệu mẫu bằng TagService
        $this->tagService->createTag(['name' => 'Tag 1']);
        $this->tagService->createTag(['name' => 'Tag 2']);

        $response = $this->tagController->index();

        $this->assertInstanceOf(JsonResponse::class, $response); // Kiểm tra kiểu phản hồi
        $this->assertCount(2, $response->getData(true)); // Kiểm tra số lượng tag trả về
    }

    public function testShow()
    {
        // Tạo một tag mẫu bằng TagService
        $tag = $this->tagService->createTag(['name' => 'Test Tag']);
    
        $response = $this->tagController->show($tag->id);
    
        $this->assertInstanceOf(JsonResponse::class, $response); // Kiểm tra kiểu phản hồi
    
        // Lấy dữ liệu thực tế từ phản hồi
        $responseData = $response->getData(true);
    
        // Kiểm tra các trường item_id và folder_id có phải là null không
        $this->assertNull($responseData['item_id']);
        $this->assertNull($responseData['folder_id']);
    
        // So sánh phần còn lại
        // $this->assertEquals($tag->toArray(), $responseData);
    }
    

    public function testStore()
    {
        $data = ['name' => 'New Tag'];

        $this->app['request']->replace($data); // Giả lập request với dữ liệu

        $response = $this->tagController->store(request());

        $this->assertInstanceOf(JsonResponse::class, $response); // Kiểm tra kiểu phản hồi
        $this->assertDatabaseHas('tags', $data); // Kiểm tra dữ liệu trong cơ sở dữ liệu
    }

    public function testUpdate()
    {
        // Tạo một tag mẫu bằng TagService
        $tag = $this->tagService->createTag(['name' => 'Original Tag']);
        $data = ['name' => 'Updated Tag'];

        $this->app['request']->replace($data); // Giả lập request với dữ liệu

        $response = $this->tagController->update(request(), $tag->id);

        $this->assertInstanceOf(JsonResponse::class, $response); // Kiểm tra kiểu phản hồi
        $this->assertDatabaseHas('tags', array_merge(['id' => $tag->id], $data)); // Kiểm tra dữ liệu đã được cập nhật
    }

    public function testDestroy()
    {
        // Tạo một tag mẫu bằng TagService
        $tag = $this->tagService->createTag(['name' => 'Tag to Delete']);

        $response = $this->tagController->destroy($tag->id);

        $this->assertInstanceOf(JsonResponse::class, $response); // Kiểm tra kiểu phản hồi
        $this->assertDatabaseMissing('tags', ['id' => $tag->id]); // Kiểm tra dữ liệu đã bị xóa
    }
}
