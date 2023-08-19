<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        // Remove potential HTML tags from the title and body
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        // Get the currently logged in user
        $currentUserId = auth()->id();

        // Add currentUserId to the incoming fields
        $incomingFields['author_id'] = $currentUserId;

        // Create the post
        Post::create($incomingFields);

        return redirect('home');
    }

    public function showEditScreen(Post $post){

        // Check if the user is logged in
        if (!auth()->check()) {
            return redirect('home');
        }

        // Check if the user is the author of the post
        if (auth()->id() !== $post->author_id) {
            return redirect('home');
        }

        return view('edit-post', [
            'post' => $post
        ]);
    }

    public function editPost(Request $request, Post $post){
        // Check if the user is logged in
        if (!auth()->check()) {
            return redirect('home');
        }

        // Check if the user is the author of the post
        if (auth()->id() !== $post->author_id) {
            return redirect('home');
        }


        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        // Remove potential HTML tags from the title and body
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        // Update the post
        $post->update($incomingFields);

        return redirect('home');
    }

    public function deletePost(Post $post){
        // Check if the user is logged in
        if (!auth()->check()) {
            return redirect('home');
        }

        // Check if the user is the author of the post
        if (auth()->id() !== $post->author_id) {
            return redirect('home');
        }

        $post->delete();

        return redirect('home');
    }

}
