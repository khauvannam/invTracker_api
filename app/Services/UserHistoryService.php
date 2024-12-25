<?php

namespace App\Services;


use App\Repositories\UsersHistory\UserHistoryRepository;

class UserHistoryService
{
    protected UserHistoryRepository $repository;

    public function __construct(UserHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createHistory(array $data): array
    {
        return $this->repository->createHistory($data);
    }

    public function find(int $id): array
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
