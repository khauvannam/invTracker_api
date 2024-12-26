<?php

namespace Tests\Unit\Controllers\Auth;

use App\Models\User;
use Tests\TestCase;
use Mockery;
use App\Services\UserService;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Http\JsonResponse;

class UserControllerTest extends TestCase
{
    protected UserService $userService;
    protected UserController $userController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = Mockery::mock(UserService::class);
        $this->userController = new UserController($this->userService);
    }

    public function testIndex()
    {
        $users = User::factory()->count(2)->create();

        $this->userService
            ->shouldReceive('all')
            ->once()
            ->andReturn($users->toArray());

        $response = $this->userController->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($users->toArray(), $response->getData(true));
    }

    public function testShow()
    {
        $user = User::factory()->create();

        $this->userService
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($user);

        $response = $this->userController->show(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($user->toArray(), $response->getData(true));
    }

    public function testStore()
    {
        $createdUser = User::factory()->make();

        $this->userService
            ->shouldReceive('create')
            ->with($createdUser->toArray())
            ->once()
            ->andReturn($createdUser);

        // Mock the request data
        $this->app['request']->replace($createdUser->toArray());

        // Call the controller method
        $response = $this->userController->store();

        // Assertions
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($createdUser->toArray(), $response->getData(true));
    }

    public function testUpdate()
    {
        $data = [
            'name' => 'John Updated',
            'email' => 'johnupdated@example.com',
            'information' => 'Updated information',
            'preferences' => ['theme' => 'light'],
            'company_details' => ['name' => 'Updated Corp'],
            'addresses' => ['home' => '789 Maple St'],
        ];

        // Mock the userService's update method to return true (indicating success)
        $this->userService
            ->shouldReceive('update')
            ->with(1, $data)
            ->once()
            ->andReturn(true);

        // Mock the request data
        $this->app['request']->replace($data);

        // Call the controller's update method
        $response = $this->userController->update(1);

        // Assertions
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(['success' => true], $response->getData(true));
    }

    public function testDestroy()
    {
        $this->userService
            ->shouldReceive('delete')
            ->with(1)
            ->once()
            ->andReturn(true);

        $response = $this->userController->destroy(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(['success' => true], $response->getData(true));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
