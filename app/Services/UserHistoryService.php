<?php

namespace App\Services;


use App\Repositories\UsersHistory\UserHistoryRepository;
use App\Models\Histories\UserHistory;


class UserHistoryService
{
    protected UserHistoryRepository $repository;

    public function __construct(UserHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createHistory(array $data): UserHistory
    {
        return $this->repository->createHistory($data);
    }

    public function find(int $id): UserHistory
    {
        return $this->repository->find($id);
    }
    
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function show(): array
    {
        return $this->repository->show();
    }

}
