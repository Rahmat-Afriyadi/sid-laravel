<?php

namespace App\Http\Controllers;

use App\Http\Requests\Desa\DesaStoreRequest;
use App\Http\Requests\Desa\DesaUpdateRequest;
use App\Models\Desa;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class DesaController extends Controller
{

    public function store(DesaStoreRequest $request)
    {
        $data = $request->validated();
        Desa::create($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function update(DesaUpdateRequest $request, Desa $desa)
    {
        $validatedData = $request->validated();
        $desa->update($validatedData);

        return response()->json([
            'message' => 'Data berhasil diperbarui',
            'data' => $desa
        ]);
    }
    //
    public function show()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $desa = Desa::find($user->desa_id);
        $desa->geografis;
        return $desa;
    }
}
