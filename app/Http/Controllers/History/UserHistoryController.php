<?php

namespace App\Http\Controllers\History;

use App\Http\Controllers\Controller;
use App\Services\UserHistoryService;

class UserHistoryController extends Controller
{
    protected UserHistoryService $service;

    public function __construct(UserHistoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->show();
        return response()->json($data);
    }

    public function show(int $id)
    {
        $data = $this->service->find($id);
        return response()->json($data);
    }

    public function store()
    {
        $data = request()->all();
        $history = $this->service->createHistory($data);
        return response()->json($history);
    }

    public function destroy(int $id)
    {
        $deleted = $this->service->delete($id);
        return response()->json(['success' => $deleted]);
    }

}
