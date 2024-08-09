<?php

namespace App\Repositories;

use app\Models\User;
use App\Models\Follow;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {
    public function findByUsername(string $username): ?User
    {
        return User::where('username', $username)->first();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function updateAvatar(User $user, string $filename): void
    {
        $user->avatar = $filename;
        $user->save();
    }

    public function followStatus(User $currentUser, User $targetUser): bool
    {
        return Follow::where('user_id', $currentUser->id)
                     ->where('followeduser', $targetUser->id)
                     ->exists();
    }
}