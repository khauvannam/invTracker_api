<?php

namespace App\Services;

use App\Models\Folders\Folder;

class FolderService
{

    public function getAllFolders()
    {
        return Folder::all();
    }


    public function getFolderById(int $id)
    {
        return Folder::find($id);
    }


    public function createFolder(array $data)
    {
        return Folder::create($data);
    }


    public function updateFolder(int $id, array $data)
    {
        $folder = Folder::findOrFail($id);
        $folder->update($data);
        return $folder;
    }


    public function deleteFolder(int $id)
    {
        $folder = Folder::findOrFail($id);
        $folder->delete();
        return true;
    }
}
