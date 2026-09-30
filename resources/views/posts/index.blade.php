@extends('layouts.app')

@section('title', 'Semua Post')

@section('content')

    <x-alert />

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Daftar Post</h3>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Tambah Post</a>
    </div>

    <form method="GET" action="{{ route('posts.index') }}" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ $keyword }}"
                class="form-control"
                placeholder="Cari judul atau isi post..."
            >
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
            @if ($keyword)
                <a href="{{ route('posts.index') }}" class="btn btn-outline-danger">Reset</a>
            @endif
        </div>
    </form>

    @forelse ($posts as $post)
        <x-card :title="$post->title">
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-thumbnail mb-2" style="max-width: 200px;">
            @endif

            <p class="mb-2">{{ substr($post->content, 0, 150) }}{{ strlen($post->content) > 150 ? '...' : '' }}</p>

            <div class="d-flex gap-2">
                <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-info text-white">Detail</a>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Hapus post ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </x-card>
    @empty
        <p class="text-muted">
            @if ($keyword)
                Tidak ada post yang cocok dengan pencarian "{{ $keyword }}".
            @else
                Belum ada post. Silakan tambah post baru.
            @endif
        </p>
    @endforelse

    {{ $posts->links('pagination::bootstrap-5') }}

@endsection