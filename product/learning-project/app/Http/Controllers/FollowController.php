<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use App\Repositories\FollowRepository;

class FollowController extends Controller
{
    protected $followRepository;

    public function __construct(FollowRepository $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    public function createFollow(User $user)
    {
        $userId = auth()->user()->id;
        $followedUserId = $user->id;

        if ($this->followRepository->checkIfUserFollow($userId, $followedUserId)) {
            return back()->with('failure', 'You are already following that user.');
        }

        $this->followRepository->createFollow($userId, $followedUserId);
        return back()->with('success', 'Successfully!');
    }

    public function removeFollow(User $user)
    {
        $userId = auth()->user()->id;
        $followedUserId = $user->id;
        
        $this->followRepository->removeFollow($userId, $followedUserId);
        return back()->with('success', 'Unfollowed successfully!');
    }
}
