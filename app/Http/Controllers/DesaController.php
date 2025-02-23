<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class DesaController extends Controller
{
    //
    public function show()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $desa = Desa::find($user->desa_id);
        $desa->geografis;
        return $desa;
    }
}
