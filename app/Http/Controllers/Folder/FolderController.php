<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Services\FolderService;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    protected FolderService $folderService;

    public function __construct(FolderService $folderService)
    {
        $this->folderService = $folderService;
    }

    public function index()
    {
        $folders = $this->folderService->getAllFolders();
        return response()->json($folders);
    }

    public function show($id)
    {
        $folder = $this->folderService->getFolderById($id);
        return response()->json($folder);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $folder = $this->folderService->createFolder($data);
        return response()->json($folder, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $folder = $this->folderService->updateFolder($id, $data);
        return response()->json($folder);
    }

    public function destroy($id)
    {
        $this->folderService->deleteFolder($id);
        return response()->json(['message' => 'Folder deleted successfully']);
    }
}
