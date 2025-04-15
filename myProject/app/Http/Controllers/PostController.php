<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        // La validation est déjà gérée par StorePostRequest

        // Création du post
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Redirection avec message de succès
        return redirect()->route('posts.index')
            ->with('success', 'L\'article a été créé avec succès!');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        // La validation est déjà gérée par StorePostRequest

        // Mise à jour du post
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Redirection avec message de succès
        return redirect()->route('posts.show', $post)
            ->with('success', 'L\'article a été modifié avec succès!');
    }

    public function destroy(Post $post)
    {
        // Suppression du post
        $post->delete();

        // Redirection avec message de succès
        return redirect()->route('posts.index')
            ->with('success', 'L\'article a été supprimé avec succès!');
    }
}
