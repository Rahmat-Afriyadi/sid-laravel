<?php

namespace App\Http\Requests\Geografi;

use Illuminate\Foundation\Http\FormRequest;

class GeografiStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
             'luas_wilayah' => 'required|numeric|min:0',
            'batas_utara' => 'required|string|max:255',
            'batas_selatan' => 'required|string|max:255',
            'batas_timur' => 'required|string|max:255',
            'batas_barat' => 'required|string|max:255',
            'radius_kecamatan' => 'required|numeric|min:0',
            'radius_kabupaten' => 'required|numeric|min:0',
            'radius_provinsi' => 'required|numeric|min:0',
            'radius_negara' => 'required|numeric|min:0',
            'desa_id' => 'required|exists:desas,id',
        ];
    }
}
