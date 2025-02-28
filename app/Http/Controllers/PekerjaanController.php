<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pekerjaan\PekerjaanStoreRequest;
use App\Http\Requests\Pekerjaan\PekerjaanUpdateRequest;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    //
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
