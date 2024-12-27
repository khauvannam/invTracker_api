<?php

namespace Tests\Unit\Controllers\Folder;

use App\Models\Folders\Folder;
use Tests\TestCase;
use Mockery;
use App\Services\FolderService;
use App\Http\Controllers\Folder\FolderController;
use Illuminate\Http\JsonResponse;

class FolderControllerTest extends TestCase
{
    protected FolderService $folderService;
    protected FolderController $folderController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->folderService = Mockery::mock(FolderService::class);
        $this->folderController = new FolderController($this->folderService);
    }

    public function testIndex()
    {
        $folders = Folder::factory()->count(2)->make();

        $this->folderService
            ->shouldReceive('getAllFolders')
            ->once()
            ->andReturn($folders->toArray());

        $response = $this->folderController->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($folders->toArray(), $response->getData(true));
    }

    public function testShow()
    {
        $folder = Folder::factory()->make();

        $this->folderService
            ->shouldReceive('getFolderById')
            ->with(1)
            ->once()
            ->andReturn($folder);

        $response = $this->folderController->show(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($folder->toArray(), $response->getData(true));
    }

    public function testStore()
    {
        $createdFolder = Folder::factory()->make();

        $this->folderService
            ->shouldReceive('createFolder')
            ->with($createdFolder->toArray())
            ->once()
            ->andReturn($createdFolder);

        // Mock the request data
        $this->app['request']->replace($createdFolder->toArray());

        // Call the controller method
        $response = $this->folderController->store();

        // Assertions
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($createdFolder->toArray(), $response->getData(true));
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'Updated Folder Name',
        ];

        $this->folderService
            ->shouldReceive('updateFolder')
            ->with(1, $data)
            ->once()
            ->andReturn(true);

        $this->app['request']->replace($data);

        $response = $this->folderController->update(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(['success' => true], $response->getData(true));
    }

    public function testDestroy()
    {
        $this->folderService
            ->shouldReceive('deleteFolder')
            ->with(1)
            ->once()
            ->andReturn(true);

        $response = $this->folderController->destroy(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(['message' => 'Folder deleted successfully'], $response->getData(true));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
