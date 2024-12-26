<?php

namespace App\Repositories\UsersHistory;

use App\Models\Histories\UserHistory;

class UserHistoryRepository
{
    protected UserHistory $UserHistory;

    public function __construct(UserHistory $UserHistory)
    {
        $this->UserHistory = $UserHistory;
    }

    public function createHistory(array $data): UserHistory
    {
        return $this->UserHistory->create($data);
    }

    public function find(int $id): UserHistory
    {
        return $this->UserHistory->find($id);
    }

    public function delete(int $id): bool
    {
        return $this->UserHistory->find($id)->delete();
    }

    public function show(): array
    {
        return $this->UserHistory->all()->toArray();
    }


}
