<?php

namespace App\Http\Controllers\Folder;

use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class FolderController extends Controller
{
    public function getAll(): Collection|array
    {
        return Folder::all();
    }

    public function findById(int $id): Folder|array|null
    {
        return Folder::find($id);
    }

    public function create(array $data): Folder
    {
        return Folder::create($data);
    }

    public function update(int $id, array $data): Folder
    {
        $folder = Folder::findOrFail($id);
        $folder->update($data);
        return $folder;
    }

    public function delete(int $id): bool
    {
        $folder = Folder::findOrFail($id);
        $folder->delete();
        return true;
    }
}
