<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'Please enter menu name!'
        ];
    }
}
