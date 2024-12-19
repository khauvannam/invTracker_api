<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

   
    public function index()
    {
        return response()->json($this->itemService->getAllItems());
    }

   
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'alert' => 'required|integer',
            'price' => 'required|numeric',
            'folder_id' => 'required|integer|exists:folders,id',
            'images' => 'nullable|array',
            'notes' => 'nullable|string',
            'field' => 'nullable|array',
        ]);

        return response()->json($this->itemService->createItem($data), 201);
    }

    
    public function show($id)
    {
        return response()->json($this->itemService->getItemById($id));
    }

   
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'alert' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'folder_id' => 'nullable|integer|exists:folders,id',
            'images' => 'nullable|array',
            'notes' => 'nullable|string',
            'field' => 'nullable|array',
        ]);

        return response()->json($this->itemService->updateItem($id, $data));
    }

    public function destroy($id)
    {
        $this->itemService->deleteItem($id);
        return response()->json(null, 204);
    }
}
