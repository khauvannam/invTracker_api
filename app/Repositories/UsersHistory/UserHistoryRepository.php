<?php

namespace App\Repositories\UsersHistory;

use App\Models\Histories\UserHistory;

class UsersHistoryRepository
{
    protected UserHistory $UserHistory;

     public function __construct(UserHistory $UserHistory) {
        $this->UserHistory = $UserHistory;
    }
    public function createHistory($userId, $activityType, $folderId, $itemId)
    {
        return $this->UserHistory->create([
            'user_id' => $userId,
            'activity_type' => $activityType,
            'folder_id'=> $folderId, 
            'item_id'=>$itemId

        ]);
    }
    public function show(){
        return $this->UserHistory->all()->toArray();
    }
}