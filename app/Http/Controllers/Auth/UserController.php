<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $user = $this->userService->all();
        return response()->json($user);
    }
    public function show(int $id)
    {
        $user = $this->userService->find($id);
        return response()->json($user);
    }
    public function store()
    {
        $data = request()->all();
        $user = $this->userService->create($data);
        return response()->json($user);
    }
    public function update(int $id)
    {
        $data = request()->all();
        $user = $this->userService->update($id, $data);
        return response()->json($user);
    }
    public function destroy(int $id)
    {
        $user = $this->userService->delete($id);
        return response()->json($user);
    }

}
