@extends('layouts.app')
@section('title', $post->title)
@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $post->title }}</h1>
            <p class="card-text">{{ $post->content }}</p>
        </div>
    </div>

    <div class="mt-4">
        <h3>Commentaires ({{ $post->comments->count() }})</h3>
        @foreach ($post->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <p class="card-text">{{ $comment->content }}</p>
                    <small class="text-muted">
                        Posté {{ $comment->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        @endforeach

        <form method="POST" action="/posts/{{ $post->id }}/comments" class="mt-4">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" placeholder="Votre commentaire..." required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Ajouter un commentaire</button>
        </form>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="card-title mb-0">{{ $post->title }}</h1>
            <div>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Modifier</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
