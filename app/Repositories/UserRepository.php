<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function create(array $data): User
    {
        return $this->user->create($data);
    }
    public function update(int $id, array $data): bool
    {
        return $this->user->find($id)->update($data);
    }
    public function delete(int $id): bool
    {
        return $this->user->find($id)->delete();
    }
    public function find(int $id): User
    {
        return $this->user->find($id);
    }
    public function all(): array
    {
        return $this->user->all()->toArray();
    }
}
