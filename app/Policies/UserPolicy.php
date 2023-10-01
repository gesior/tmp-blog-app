<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAdminAccess();
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasAdminAccess();
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasAdminAccess();
    }

    public function delete(User $user, User $model): bool
    {
        return $user->hasAdminAccess();
    }

    public function restore(User $user, User $model): bool
    {
        return $user->hasAdminAccess();
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasAdminAccess();
    }
}
