@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <x-card :title="$post->title">
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded mb-3">
        @endif

        <p style="white-space: pre-line;">{{ $post->content }}</p>

        <small class="text-muted d-block">Dibuat: {{ $post->created_at->format('d M Y, H:i') }}</small>
        @if ($post->updated_at->ne($post->created_at))
            <small class="text-muted d-block">Diperbarui: {{ $post->updated_at->format('d M Y, H:i') }}</small>
        @endif
    </x-card>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali ke Daftar Post</a>

@endsection