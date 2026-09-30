@extends('layouts.app')

@section('title', 'Tambah Post')

@section('content')

    <h3 class="mb-3">Tambah Post Baru</h3>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
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
            >{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar (opsional, BONUS)</label>
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

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
    </form>

@endsection