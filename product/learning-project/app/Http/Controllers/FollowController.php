<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function createFollow(User $user) {
        $newFollow = new Follow;
        $newFollow-> user_id = auth()->user()->id;
        $newFollow->followeduser = $user->id;
        $newFollow->save();

    }

    public function removeFollow() {
        
    }
}
