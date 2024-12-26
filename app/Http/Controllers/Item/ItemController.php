<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Services\Item\ItemService;
use App\Services\Item\ItemRelationshipService; 
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected ItemService $itemService;
    protected ItemRelationshipService $itemRelationshipService; 

    public function __construct(ItemService $itemService, ItemRelationshipService $itemRelationshipService) 
    {
        $this->itemService = $itemService;
        $this->itemRelationshipService = $itemRelationshipService; 
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
        ]);

        return response()->json($this->itemService->updateItem($id, $data));
    }

    public function destroy($id)
    {
        $this->itemService->deleteItem($id);
        return response()->json(null, 204);
    }
    public function addRelationship(Request $request, $itemId)
    {
        $data = $request->validate([
            'tag_id' => 'required|integer|exists:tags,id',
        ]);
    
        $itemRelationship = $this->itemRelationshipService->createItemRelationship($itemId, $data);
    
        return response()->json($itemRelationship, 201);
    }
    
    public function getRelationships($itemId)
    {
        $itemRelationships = $this->itemRelationshipService->getItemRelationships($itemId);
        return response()->json($itemRelationships);
    }
    
    public function removeRelationship($itemId, $relationshipId)
    {
        $this->itemRelationshipService->deleteItemRelationship($itemId, $relationshipId);
        return response()->json(null, 204);
    }
}
