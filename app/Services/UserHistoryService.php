<?php

namespace App\Services;

use App\Repositories\UsersHistory\UserHistoryRepository;


class UserHistoryService
{
   protected UserHistoryRepository $repository;

   public function __construct(UserHistoryRepository $repository){
    $this->repository=$repository;
   }

   public function  createHistory($userId, $activityType, $folderId, $itemId){
    return $this->repository->createHistory($userId, $activityType, $folderId, $itemId);
   }
public function show(){
    return $this->repository->show();
}

}
