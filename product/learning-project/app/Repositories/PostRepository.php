<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function search($term){
        return Post::search($term)->get();
    }

    public function delete(Post $post){
        return $post->delete();
    }

    public function update(Post $post, array $data){
        return $post->update($data);
    }

    public function create(array $data){
        return Post::create($data);
    }

    public function find(Post $post){
        return $post;
    }
}