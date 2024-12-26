<?php

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Models\Folders\folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index()
    {
        return folder::all();
    }
    public function store(Request $request)
    {
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
        ]);
        $folder->update($data);
        return $folder;
    }
    public function destroy(folder $folder)
    {
        $folder->delete();
        return response()->json();
    }
}
