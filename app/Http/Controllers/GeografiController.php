<?php

namespace App\Http\Controllers;

use App\Http\Requests\Geografi\GeografiStoreRequest;
use App\Http\Requests\Geografi\GeografiUpdateRequest;
use App\Models\Geografi;
use Illuminate\Http\Request;

class GeografiController extends Controller
{
    //
    public function store(GeografiStoreRequest $request)
    {
        $data = $request->validated();
        Geografi::create($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function update(GeografiUpdateRequest $request, Geografi $geografi)
    {
        $validatedData = $request->validated();
        $geografi->update($validatedData);

        return response()->json([
            'message' => 'Data berhasil diperbarui',
            'data' => $geografi
        ]);
    }
}
