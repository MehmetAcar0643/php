<?php

namespace App\Http\Requests\ProjectImage;

use Illuminate\Foundation\Http\FormRequest;

class ProjectImageCreateRequest extends FormRequest
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
            'imagefile' => 'required|max:2048',

        ];
    }

    public function attributes()
    {
        return [
            'imagefile'=>'Resim Seçme',
        ];
    }
}
