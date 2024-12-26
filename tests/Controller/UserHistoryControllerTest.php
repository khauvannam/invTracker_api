<?php

namespace Tests\Controller;

use App\Http\Controllers\History\UserHistoryController;
use App\Models\Histories\UserHistory;
use App\Services\UserHistoryService;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;

class UserHistoryControllerTest extends TestCase
{
    protected UserHistoryService $userHistoryService;
    protected UserHistoryController $userHistoryController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userHistoryService = Mockery::mock(UserHistoryService::class);
        $this->userHistoryController = new UserHistoryController($this->userHistoryService);
    }

    public function testIndex()
    {
        $histories = [
            [
                'id' => 1,
                'user_id' => 1,
                'activity_type' => 'create',
                'folder_id' => null,
                'item_id' => 123,
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'activity_type' => 'delete',
                'folder_id' => 10,
                'item_id' => null,
            ],
        ];

        $this->userHistoryService
            ->shouldReceive('show')
            ->once()
            ->andReturn($histories);

        $response = $this->userHistoryController->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($histories, $response->getData(true));
    }

    public function testShow()
    {
        $history = UserHistory::factory()->make(['id' => 1]); // Tạo một đối tượng giả lập từ factory

        $this->userHistoryService
            ->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($history);

        $response = $this->userHistoryController->show(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($history->toArray(), $response->getData(true));
    }

    public function testStore()
    {
        $data = [
            'user_id' => 1,
            'activity_type' => 'create',
            'folder_id' => null,
            'item_id' => 123,
        ];

        $history = UserHistory::factory()->make(array_merge(['id' => 1], $data));

        $this->userHistoryService
            ->shouldReceive('createHistory')
            ->once()
            ->with($data)
            ->andReturn($history);

        // Giả lập request với dữ liệu
        $this->app['request']->replace($data);

        $response = $this->userHistoryController->store();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($history->toArray(), $response->getData(true));
    }


    public function testDestroy()
    {
        $this->userHistoryService
            ->shouldReceive('delete')
            ->once()
            ->with(1)
            ->andReturn(true); // Trả về kiểu bool

        $response = $this->userHistoryController->destroy(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(['success' => true], $response->getData(true)); // Kiểm tra phản hồi
    }
}
