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
}
