<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pendidikan\PendidikanStoreRequest;
use App\Http\Requests\Pendidikan\PendidikanUpdateRequest;
use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    //
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
