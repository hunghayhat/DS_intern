<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;

class FollowController extends Controller
{
    public function createFollow(User $user)
    {
        $existCheck =
            Follow::where([
                ['user_id', '=', auth()->user()->id],
                ['followeduser', '=', $user->id]
            ])->count();

        if ($existCheck) {
            return back()->with('failure', 'You are already following that user.');
        }

        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followeduser = $user->id;
        $newFollow->save();

        return back()->with('success', 'Successfully!');
    }

    public function removeFollow(User $user)
    {
        Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->delete();
        return back()->with('success', 'Unfollow successfuly!');
    }
}
