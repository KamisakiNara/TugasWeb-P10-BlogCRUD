@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

    <h3 class="mb-3">Edit Post</h3>

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $post->title) }}"
                class="form-control @error('title') is-invalid @enderror"
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Isi Konten</label>
            <textarea
                id="content"
                name="content"
                rows="6"
                class="form-control @error('content') is-invalid @enderror"
            >{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if ($post->image)
            <div class="mb-3">
                <label class="form-label d-block">Gambar Saat Ini</label>
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-thumbnail" style="max-width: 200px;">
            </div>
        @endif

        <div class="mb-3">
            <label for="image" class="form-label">Ganti Gambar (opsional, BONUS)</label>
            <input
                type="file"
                id="image"
                name="image"
                class="form-control @error('image') is-invalid @enderror"
            >
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
    </form>

@endsection