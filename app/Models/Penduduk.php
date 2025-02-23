<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Desa;

class Penduduk extends Model
{
    //

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }

}
