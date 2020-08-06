<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail.*' => 'max:2048|mimes:jpg,png',
            'is_published' => 'required|boolean'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Judul tidak boleh kosong',
            'content.required' => 'Konten tidak boleh kosong',
            'is_published.required' => 'Konten tidak boleh kosong',
            'is_published.boolean' => 'Hanya boleh True atau False, jangan nakal ya',
            'thumbnail.mimes' => 'Format file harus berbentuk jpg atau png',
            'thumbnail.size' => 'Ukuran maksimal 2MB',

        ];
    }
}
