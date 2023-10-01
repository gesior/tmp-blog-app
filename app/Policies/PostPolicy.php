<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasEditorAccess() || $user->hasAdminAccess();
    }

    public function update(User $user, Post $post): bool
    {
        return $user->hasEditorAccess() || $user->hasAdminAccess();
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->hasEditorAccess() || $user->hasAdminAccess();
    }

    public function restore(User $user, Post $post): bool
    {
        return $user->hasEditorAccess() || $user->hasAdminAccess();
    }

    public function forceDelete(User $user, Post $post): bool
    {
        return $user->hasEditorAccess() || $user->hasAdminAccess();
    }
}
