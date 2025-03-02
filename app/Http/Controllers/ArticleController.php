<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\ArticleStoreRequest;
use App\Http\Requests\Article\ArticleUpdateBannerRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        return Article::with("kategori")->paginate(10); // Menampilkan 10 artikel per halaman
    }

    public function show(Article $article)
    {
        return $article; // Menampilkan 10 artikel per halaman
    }

    public function store(ArticleStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Upload banner dan simpan path-nya
        $user = JWTAuth::parseToken()->authenticate();
        $path = $request->file('banner')->store('banners', 'public');
        $data['banner'] = Storage::url($path);
        $data['author'] = $user->name;
        $data['tgl_publikasi'] = date("Y-m-d");

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

        // Update artikel dengan data baru
        $article->update($data);

        return response()->json([
            'message' => 'Artikel berhasil diperbarui',
            'data' => $article
        ]);
    }

    public function updateBanner(ArticleUpdateBannerRequest $request, Article $article)
    {
        $data = $request->all();
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
