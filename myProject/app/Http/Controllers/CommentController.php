<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        request()->validate(['content' => 'required|min:3']);
        $post->comments()->create([
            'content' => request('content')
        ]);
        return back(); // Redirige vers la page du post
    }
}
