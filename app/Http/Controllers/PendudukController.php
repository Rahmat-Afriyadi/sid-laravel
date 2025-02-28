<?php

namespace App\Http\Controllers;

use App\Http\Requests\Penduduk\PendudukStoreRequest;
use App\Http\Requests\Penduduk\PendudukUpdateRequest;
use App\Models\Desa;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    //

    public function store(PendudukStoreRequest $request)
    {
        $data = $request->validated();
        Penduduk::create($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function update(PendudukUpdateRequest $request, Penduduk $penduduk)
    {
        $validatedData = $request->validated();
        $penduduk->update($validatedData);

        return response()->json([
            'message' => 'Data berhasil diperbarui',
            'data' => $penduduk
        ]);
    }



    public function grafikByAgama()
    {

        $user = JWTAuth::parseToken()->authenticate();
        $datas =  DB::table('penduduks')
                ->select('agama as name', DB::raw('COUNT(*) as y'))
                ->where('desa_id', $user->id)
                ->groupBy('agama')
                ->get();
        return $datas;
    }

    public function grafikByGender()
    {

        $user = JWTAuth::parseToken()->authenticate();
        $datas =  DB::table('penduduks')
                ->select('jenis_kelamin as name', DB::raw('COUNT(*) as y'))
                ->where('desa_id', $user->id)
                ->groupBy('jenis_kelamin')
                ->pluck('y','name');
        return [
            ["name"=>"Laki-laki","y"=>$datas["L"]],
            ["name"=>"Perempuan","y"=>$datas["P"]]
        ];
    }

    public function grafikByPendidikan()
    {

        $user = JWTAuth::parseToken()->authenticate();
        $penduduk =  Penduduk::selectRaw('pendidikan_id, COUNT(*) as total')
            ->where('desa_id', $user->id)
            ->groupBy('pendidikan_id')
            ->with('pendidikan')
            ->get();
        $datas = [];
        foreach ($penduduk as $key => $value) {
            array_push($datas,["name"=>$value->pendidikan->nama, "y"=>$value->total]);
        }
        return $datas;
    }

    public function grafikByPekerjaan()
    {

        $user = JWTAuth::parseToken()->authenticate();
        $penduduk =  Penduduk::selectRaw('pekerjaan_id, COUNT(*) as total')
            ->where('desa_id', $user->id)
            ->groupBy('pekerjaan_id')
            ->with('pekerjaan')
            ->get();
        $datas = [];
        foreach ($penduduk as $key => $value) {
            array_push($datas,["name"=>$value->pekerjaan->nama, "y"=>$value->total]);
        }
        return $datas;
    }

    public function grafikByUsia()
    {

        $user = JWTAuth::parseToken()->authenticate();

        $ranges = [];
        for ($i = 0; $i <= 80; $i += 5) {
            $ranges["$i-" . ($i + 5) . " Tahun"] = 0;
        }

        // Ambil data dari database & lakukan group by usia
        $usiaGroups = DB::table('penduduks')
            ->select(
                DB::raw("
                    CONCAT(
                        FLOOR(TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) / 5) * 5, 
                        '-', 
                        (FLOOR(TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) / 5) * 5) + 5, 
                        ' Tahun'
                    ) AS name
                "),
                DB::raw('COUNT(*) as y')
            )
            ->where('desa_id', $user->id)
            ->groupBy('name')
            ->orderByRaw("MIN(TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()))")
            ->pluck('y', 'name'); // Ambil hasil sebagai key-value array
        // Gabungkan hasil query dengan range default (supaya range yang kosong tetap muncul)
        $finalResult = array_merge($ranges, $usiaGroups->toArray());
        $datas = [];

        $lebih60 = 0;
        foreach ($finalResult as $key => $value) {
            $a = explode("-", $key);
            if ((int)$a[0] > 69) {
                $lebih60 += $value;
                continue;
            }else {
                array_push($datas, [$key,$value]);
            }
        }
        array_push($datas, ["> 70 tahun", $lebih60]);
        return $datas;
    }
}
