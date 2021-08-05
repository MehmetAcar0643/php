<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectEditRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'file' => 'mimes:jpg,png,jpeg|max:2048',
            'baslangic' => "required|date",
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Başlık',
            'description' => 'Açıklama',
            'file'=>'Kapak Fotoğrafı',
            'baslangic' => "Başlangıç Tarihi",
        ];
    }
}
