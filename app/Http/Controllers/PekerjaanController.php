<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pekerjaan\PekerjaanStoreRequest;
use App\Http\Requests\Pekerjaan\PekerjaanUpdateRequest;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    //
    public function index(Request $request)
    {
        return Pekerjaan::paginate(10); // Menampilkan 10 artikel per halaman
    }
    public function show(Pekerjaan $pekerjaan)
    {
        return $pekerjaan; // Menampilkan 10 artikel per halaman
    }

    public function options()
    {
        $data = Pekerjaan::get();
        $res = [];
        foreach ($data as $key => $v) {
            array_push($res,["id"=>$v->id,"label"=>$v->nama]);
        }
        return response()->json($res);
    }

    public function store(PekerjaanStoreRequest $request)
    {
        $data = $request->validated();
        Pekerjaan::create($data);
        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function update(PekerjaanUpdateRequest $request, Pekerjaan $pekerjaan)
    {
        $validatedData = $request->validated();
        $pekerjaan->update($validatedData);

        return response()->json([
            'message' => 'Data berhasil diperbarui',
            'data' => $pekerjaan
        ]);
    }
}
