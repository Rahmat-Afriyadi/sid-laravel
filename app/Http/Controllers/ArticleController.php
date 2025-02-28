<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\ArticleStoreRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function store(ArticleStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Upload banner dan simpan path-nya
        $path = $request->file('banner')->store('banners', 'public');
        $data['banner'] = Storage::url($path);

        // Simpan artikel dengan data yang sudah tervalidasi
        $article = Article::create($data);

        return response()->json([
            'message' => 'Artikel berhasil ditambahkan',
            'data' => $article
        ], 201);
    }

    public function update(ArticleUpdateRequest $request, Article $article): JsonResponse
    {
        $data = $request->validated();

        // Jika ada file banner baru yang diunggah, hapus yang lama dan simpan yang baru
        if ($request->hasFile('banner')) {
            if ($article->banner) {
                Storage::delete(str_replace('/storage/', 'public/', $article->banner));
            }

            $path = $request->file('banner')->store('banners', 'public');
            $data['banner'] = Storage::url($path);
        }

        // Update artikel dengan data baru
        $article->update($data);

        return response()->json([
            'message' => 'Artikel berhasil diperbarui',
            'data' => $article
        ]);
    }
}
