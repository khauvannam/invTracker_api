<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Models\Folders\Folder;
=======
use App\Models\Folders\folder;
>>>>>>> origin/namdeptrai
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $folders = Folder::with(['child', 'tags'])->get();

        return response()->json([
            'success' => true,
            'data' => $folders,
        ]);
=======
        return folder::all();
>>>>>>> origin/namdeptrai
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'inventory_id' => 'nullable|integer',
            'parent_id' => 'nullable|exists:folders,id',
            'notes' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'string', // Mỗi phần tử trong mảng `photos` phải là chuỗi
            'qrcode' => 'nullable|string',
            'custom_fields' => 'nullable|array',
        ]);

        $folder = Folder::create($data);

        // Xử lý quan hệ tags nếu có
        if ($request->has('tags')) {
            $folder->tags()->sync($request->input('tags'));
        }

        return response()->json([
            'success' => true,
            'message' => 'Folder created successfully.',
            'data' => $folder->load(['child', 'tags']),
        ], 201);
    }

    public function show(Folder $folder)
    {
        $folder->load(['child', 'tags']);

        return response()->json([
            'success' => true,
            'data' => $folder,
        ]);
    }

    public function update(Request $request, Folder $folder)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'inventory_id' => 'nullable|integer',
            'parent_id' => 'nullable|exists:folders,id',
            'notes' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'string',
            'qrcode' => 'nullable|string',
            'custom_fields' => 'nullable|array',
=======
        $data = $request->validate([]);

        return folder::create($data);
    }

    public function show(folder $folder)
    {
        return $folder;
    }

    public function update(Request $request, folder $folder)
    {
        $data = $request->validate([

>>>>>>> origin/namdeptrai
        ]);

        $folder->update($data);

<<<<<<< HEAD
        // Cập nhật quan hệ tags nếu có
        if ($request->has('tags')) {
            $folder->tags()->sync($request->input('tags'));
        }

        return response()->json([
            'success' => true,
            'message' => 'Folder updated successfully.',
            'data' => $folder->load(['child', 'tags']),
        ]);
    }

    public function destroy(Folder $folder)
    {
        $folder->delete();

        return response()->json([
            'success' => true,
            'message' => 'Folder deleted successfully.',
        ]);
=======
        return $folder;
    }

    public function destroy(folder $folder)
    {
        $folder->delete();

        return response()->json();
>>>>>>> origin/namdeptrai
    }
}
