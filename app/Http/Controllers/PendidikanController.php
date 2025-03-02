<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pendidikan\PendidikanStoreRequest;
use App\Http\Requests\Pendidikan\PendidikanUpdateRequest;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    //
    public function index(Request $request)
    {
        return Pendidikan::paginate(10); // Menampilkan 10 artikel per halaman
    }

    public function show(Pendidikan $pendidikan)
    {
        return $pendidikan; // Menampilkan 10 artikel per halaman
    }

    public function options()
    {
        $data = Pendidikan::get();
        $res = [];
        foreach ($data as $key => $v) {
            array_push($res,["id"=>$v->id,"label"=>$v->nama]);
        }
        return response()->json($res);
    }

    public function store(PendidikanStoreRequest $request)
    {
        $data = $request->validated();
        Pendidikan::create($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function update(PendidikanUpdateRequest $request, Pendidikan $pendidikan)
    {
        $validatedData = $request->validated();
        $pendidikan->update($validatedData);

        return response()->json([
            'message' => 'Data berhasil diperbarui',
            'data' => $pendidikan
        ]);
    }
}
