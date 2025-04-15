@extends('layouts.app')
@section('title', 'Ajouter un article')
@section('content')
    <div class="container">
        <h1 class="mb-4">Ajouter un nouvel article</h1>

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenu</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6"
                    required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-success">Publier l'article</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
@endsection
