<?php

namespace App\Http\Controllers\Field;

use App\Services\Field\CustomFieldService;
use App\Services\Field\CustomFieldRelationshipService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomFieldController extends Controller
{
    protected $customFieldService;
    protected $customFieldRelationshipService;

    public function __construct(CustomFieldService $customFieldService, CustomFieldRelationshipService $customFieldRelationshipService)
    {
        $this->customFieldService = $customFieldService;
        $this->customFieldRelationshipService = $customFieldRelationshipService;
    }


    public function index()
    {
        $customFields = $this->customFieldService->getAll();
        return response()->json($customFields);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'placeholder' => 'nullable|string|max:255',
            'default_value' => 'nullable|string|max:255',
            'applies_to_items' => 'nullable|boolean',
            'applies_to_folders' => 'nullable|boolean',
        ]);

        $customField = $this->customFieldService->create($data);
        return response()->json($customField, 201);
    }

    public function show($id)
    {
        $customField = $this->customFieldService->getById($id);
        return response()->json($customField);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'placeholder' => 'nullable|string|max:255',
            'default_value' => 'nullable|string|max:255',
            'applies_to_items' => 'nullable|boolean',
            'applies_to_folders' => 'nullable|boolean',
        ]);

        $customField = $this->customFieldService->update($id, $data);
        return response()->json($customField);
    }

    public function destroy($id)
    {
        $this->customFieldService->delete($id);
        return response()->json(null, 204);
    }

    

        public function addRelationship(Request $request, $customFieldId)
    {
        $data = $request->validate([
            'item_id' => 'nullable|integer',
            'folder_id' => 'nullable|integer',
            'value' => 'nullable|string',
        ]);

        $relationship = $this->customFieldRelationshipService->createRelationship($customFieldId, $data);
        return response()->json($relationship, 201);
    }

    public function getRelationships($customFieldId)
    {
        $relationships = $this->customFieldRelationshipService->getRelationships($customFieldId);
        return response()->json($relationships);
    }

    public function removeRelationship($customFieldId, $relationshipId)
    {
        $this->customFieldRelationshipService->deleteRelationship($customFieldId, $relationshipId);
        return response()->json(null, 204);
    }
}

