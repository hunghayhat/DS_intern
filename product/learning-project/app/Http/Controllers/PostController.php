<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;
use App\Jobs\SendNewPostEmail;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function search($term)
    {
        $posts = $this->postRepository->search($term);
        $posts->load('user:id,username,avatar');
        return $posts;
    }

    public function delete(Post $post)
    {
        $this->postRepository->delete($post);

        return redirect('/profile/' . auth()->user()->username)->with('success', 'Post deleted successfully');
    }

    public function deleteApi(Post $post)
    {
        $this->postRepository->delete($post);
        return true;
    }

    public function edit(Post $post)
    {
        return view('edit-post', ['post' => $this->postRepository->find($post)]);
    }

    public function update(PostRequest $request, Post $post)
    {
        if ($request->user()->cannot('update', $post)) {
            return ('You can not do that!');
        }
        $incomingFields = $request->validated();
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $this->postRepository->update($post, $incomingFields);

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

        $newPost = $this->postRepository->create($incomingFields);

        dispatch(new SendNewPostEmail([
            'sendTo' => auth()->user()->email,
            'name' => auth()->user()->username,
            'title' => $newPost->title
        ]));
        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created!');
    }

    public function storeNewPostApi(PostRequest $request)
    {
        $incomingFields = $request->validated();
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = $this->postRepository->create($incomingFields);

        dispatch(new SendNewPostEmail([
            'sendTo' => auth()->user()->email,
            'name' => auth()->user()->username,
            'title' => $newPost->title
        ]));
        return $newPost->id;
    }

    public function showSinglePost(Post $post)
    {
        $ourHTLM = strip_tags(Str::markdown($post->body), '<p><ul><ol><li><strong><em><h3><br>');
        $post['body'] = $ourHTLM;
        return view('single-post', ['post' => $this->postRepository->find($post)]);
    }
}
