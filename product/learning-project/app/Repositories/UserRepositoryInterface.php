<?php

namespace App\Repositories;
use App\Models\User;

interface UserRepositoryInterface {
    public function findByUserName(string $username): ?User;
    public function create(array $data): User;
    public function updateAvatar(User $user, string $filename): void;
    public function followStatus (User $currentUser, User $targetUser): bool;
}