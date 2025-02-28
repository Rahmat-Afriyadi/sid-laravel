<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends FormRequest
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
            'id' => ['required', 'integer', Rule::exists('articles', 'id')],
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'sometimes|string|max:255',
            'tgl_publikasi' => 'sometimes|date',
            'content' => 'sometimes|string',
            'kategori_id' => 'nullable|exists:kategori_articles,id',
        ];
    }
}
