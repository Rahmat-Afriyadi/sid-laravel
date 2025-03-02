<?php

namespace App\Http\Requests\Penduduk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PendudukUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nik' => [
                'nullable',
                'string',
                Rule::unique('penduduks', 'nik')->ignore($this->penduduk),
            ],
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'pendidikan_id' => 'nullable|exists:pendidikans,id',
            'pekerjaan_id' => 'nullable|exists:pekerjaans,id',
        ];
    }
}
