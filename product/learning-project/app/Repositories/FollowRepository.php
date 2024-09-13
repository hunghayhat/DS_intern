<?php   

namespace App\Repositories;

use App\Models\Follow;

class FollowRepository
{
    public function checkIfUserFollow($userId, $followedUserId)
    {
        return Follow::where([
            ['user_id', '=', $userId],
            ['followeduser', '=', $followedUserId]
        ])->count();
    }

    public function createFollow($userId, $followedUserId) {
        $newFollow = new Follow();
        $newFollow->user_id = $userId;
        
        $newFollow->followeduser = $followedUserId;
        return $newFollow->save();
    }

    public function removeFollow($userId, $followedUserId){
        return Follow::where([
            ['user_id', '=', $userId],
            ['followeduser', '=', $followedUserId]
        ])->delete();
    }
}