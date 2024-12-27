<?php

namespace App\Repositories;

use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Collection;

class FolderRepository
{
    public function getAll(): Collection|array
    {
        return Folder::all();
    }

    public function findById(int $id): Folder|array|null
    {
        return Folder::find($id);
    }

    public function create(array $data)
    {
        return Folder::create($data);
    }

    public function update(int $id, array $data): Folder|array
    {
        $folder = Folder::findOrFail($id);
        $folder->update($data);
        return $folder;
    }

    public function delete(int $id): true
    {
        $folder = Folder::findOrFail($id);
        $folder->delete();
        return true;
    }
}
