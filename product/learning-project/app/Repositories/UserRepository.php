<?php

namespace App\Repositories;

use app\Models\User;
use App\Models\Follow;

class UserRepository implements UserRepositoryInterface
{
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

    public function update(User $user, array $data): bool
    {
        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        return $user->save();
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
