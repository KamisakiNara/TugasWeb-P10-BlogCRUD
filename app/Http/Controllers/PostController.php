<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->query('search');

        $posts = Post::when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                        ->orWhere('content', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate(5)                 // KETENTUAN 8: pagination
            ->withQueryString();

        return view('posts.index', compact('posts', 'keyword'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([               // KETENTUAN 5
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {            // BONUS: upload gambar
                $validated['image'] = $request->file('image')->store('posts', 'public');
            }
            Post::create($validated);

            return redirect()->route('posts.index')
                ->with('success', 'Post berhasil ditambahkan.');   // KETENTUAN 6
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Post gagal ditambahkan, silakan coba lagi.');
        }
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }
                $validated['image'] = $request->file('image')->store('posts', 'public');
            }
            $post->update($validated);

            return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Post gagal diperbarui, silakan coba lagi.');
        }
    }

    public function destroy(Post $post)
    {
        $post->delete(); // karena pakai SoftDeletes, ini soft delete
        return redirect()->route('posts.index')->with('success', 'Post dipindahkan ke sampah.');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->latest()->paginate(5);
        return view('posts.trash', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('posts.trash')->with('success', 'Post berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->forceDelete();
        return redirect()->route('posts.trash')->with('success', 'Post dihapus permanen.');
    }
}
