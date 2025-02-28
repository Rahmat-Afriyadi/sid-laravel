<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriArticle\KategoriArticleStoreRequest;
use App\Http\Requests\KategoriArticle\KategoriArticleUpdateRequest;
use App\Models\KategoriArticle;
use Illuminate\Http\Request;

class KategoriArticleController extends Controller
{
    //
    public function store(KategoriArticleStoreRequest $request)
    {
        $data = $request->validated();
        KategoriArticle::create($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function update(KategoriArticleUpdateRequest $request, KategoriArticle $kategori_article)
    {
        $validatedData = $request->validated();
        $kategori_article->update($validatedData);

        return response()->json([
            'message' => 'Data berhasil diperbarui',
            'data' => $kategori_article
        ]);
    }
}
