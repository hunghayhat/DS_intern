<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PostController extends Controller
{
    public function showCreateForm()
    {
        return view('create-post');
    }

    public function storeNewPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);
        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created!');
    }

    public function showSinglePost(Post $post)
    {
        $ourHTLM = strip_tags(Str::markdown($post->body), '<p><ul><ol><li><strong><em><h3><br>');
        $post['body'] = $ourHTLM;
        return view('single-post', ['post' => $post]);
    }
}