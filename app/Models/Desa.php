<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penduduk;

class Desa extends Model
{
    //
    protected $guarded = ["id","created_at","updated_at"];

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'desa_id');
    }

    public function geografis()
    {
        return $this->hasOne(Geografi::class, 'desa_id');
    }
}
