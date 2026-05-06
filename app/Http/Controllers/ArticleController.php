<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class ArticleController extends Controller
{
    // GET /api/articles  (semua role)
    public function index(Request $request): JsonResponse
    {
        $articles = Article::with('admin:id,name')
            ->where('is_published', true)
            ->when($request->kategori, fn($q) => $q->where('kategori', $request->kategori))
            ->when($request->search, fn($q) => $q->where('judul', 'like', "%{$request->search}%"))
            ->latest('published_at')
            ->paginate(10);
 
        return response()->json($articles);
    }
 
    // GET /api/articles/{id}
    public function show(string $id): JsonResponse
    {
        $article = Article::with('admin:id,name')->findOrFail($id);
 
        if (!$article->is_published) {
            return response()->json(['message' => 'Artikel tidak ditemukan'], 404);
        }
 
        return response()->json(['data' => $article]);
    }
 
    // POST /api/articles  (admin only)
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'isi'           => 'required|string',
            'penulis'       => 'required|string|max:255',
            'kategori'      => 'nullable|string|max:100',
            'thumbnail_url' => 'nullable|url',
            'is_published'  => 'boolean',
        ]);
 
        $article = Article::create([
            'admin_id'      => $request->user()->id,
            'judul'         => $request->judul,
            'isi'           => $request->isi,
            'penulis'       => $request->penulis,
            'kategori'      => $request->kategori,
            'thumbnail_url' => $request->thumbnail_url,
            'is_published'  => $request->boolean('is_published', false),
            'published_at'  => $request->boolean('is_published') ? Carbon::now() : null,
        ]);
 
        return response()->json(['message' => 'Artikel berhasil dibuat', 'data' => $article], 201);
    }
 
    // PUT /api/articles/{id}  (admin only)
    public function update(Request $request, string $id): JsonResponse
    {
        $article = Article::findOrFail($id);
 
        $request->validate([
            'judul'         => 'sometimes|string|max:255',
            'isi'           => 'sometimes|string',
            'penulis'       => 'sometimes|string|max:255',
            'kategori'      => 'nullable|string|max:100',
            'thumbnail_url' => 'nullable|url',
            'is_published'  => 'boolean',
        ]);
 
        $data = $request->only(['judul', 'isi', 'penulis', 'kategori', 'thumbnail_url', 'is_published']);
 
        // Set published_at saat pertama kali dipublish
        if ($request->boolean('is_published') && !$article->is_published) {
            $data['published_at'] = Carbon::now();
        }
 
        $article->update($data);
 
        return response()->json(['message' => 'Artikel diperbarui', 'data' => $article]);
    }
 
    // DELETE /api/articles/{id}  (admin only)
    public function destroy(string $id): JsonResponse
    {
        $article = Article::findOrFail($id);
        $article->delete(); // soft delete
 
        return response()->json(['message' => 'Artikel dihapus']);
    }
}
