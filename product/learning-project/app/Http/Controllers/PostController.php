<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Symfony\Contracts\Service\Attribute\Required;

class PostController extends Controller
{
    public function search($term) {
        $posts = Post::search($term)->get();
        $posts->load('user:id,username,avatar');
        return $posts;
    }

    public function delete(Request $request, Post $post) {
        if($request->user()->cannot('delete', $post)) {
            return('You can not do that!');
        }
        $post->delete();

        return redirect('/profile/'.auth()->user()->username)->with('success', 'Post deleted successfully');
    }

    public function edit(Post $post) {
        return view('edit-post',['post'=>$post]);
    }

    public function update(PostRequest $request, Post $post) {
        if($request->user()->cannot('update', $post)) {
            return('You can not do that!');
        }
        $incomingFields = $request->validated();
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);

        return redirect("/post/{$post->id}")->with('success', 'Post updated successfully');
    }

    public function showCreateForm()
    {
        return view('create-post');
    }

    public function storeNewPost(PostRequest $request)
    {
        $incomingFields = $request->validated();
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
