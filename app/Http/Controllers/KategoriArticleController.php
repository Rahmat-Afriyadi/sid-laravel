<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriArticle\KategoriArticleStoreRequest;
use App\Http\Requests\KategoriArticle\KategoriArticleUpdateRequest;
use App\Models\KategoriArticle;
use Illuminate\Http\Request;

class KategoriArticleController extends Controller
{
    //
    public function index(Request $request)
    {
        return KategoriArticle::paginate(10); // Menampilkan 10 artikel per halaman
    }

    public function show(KategoriArticle $kategori)
    {
        return $kategori; // Menampilkan 10 artikel per halaman
    }

    public function options()
    {
        $data = KategoriArticle::get();
        $res = [];
        foreach ($data as $key => $v) {
            array_push($res,["id"=>$v->id,"label"=>$v->nama]);
        }
        return response()->json($res);
    }

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
