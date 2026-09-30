@extends('layouts.app')

@section('title', 'Sampah')

@section('content')

    <x-alert />

    <h3 class="mb-3">Sampah (Post Terhapus)</h3>
    <p class="text-muted">
        BONUS soft delete: post di bawah ini belum benar-benar hilang dari database,
        hanya disembunyikan dari daftar utama. Post bisa dikembalikan atau dihapus permanen.
    </p>

    @forelse ($posts as $post)
        <x-card :title="$post->title">
            <p class="mb-2">{{ substr($post->content, 0, 150) }}{{ strlen($post->content) > 150 ? '...' : '' }}</p>
            <small class="text-muted d-block mb-2">Dihapus: {{ $post->deleted_at->format('d M Y, H:i') }}</small>

            <div class="d-flex gap-2">
                <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-success">Kembalikan</button>
                </form>

                <form action="{{ route('posts.force-delete', $post->id) }}" method="POST" onsubmit="return confirm('Hapus permanen? Data tidak bisa dikembalikan lagi.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Hapus Permanen</button>
                </form>
            </div>
        </x-card>
    @empty
        <p class="text-muted">Sampah kosong.</p>
    @endforelse

    {{ $posts->links('pagination::bootstrap-5') }}

@endsection