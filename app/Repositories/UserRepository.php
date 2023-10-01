<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function findAll(): Collection
    {
        return $this->user::all();
    }

    public function paginate(int $itemsPerPage = 10)
    {
        return $this->user::paginate($itemsPerPage);
    }

    public function find($userId)
    {
        return $this->user::findOrFail($userId);
    }

    public function create(array $data)
    {
        return $this->user::create($data);
    }

    public function update($userId, array $data)
    {
        return $this->user::whereId($userId)->update($data);
    }

    public function delete($userId): void
    {
        $this->user::destroy($userId);
    }
}
