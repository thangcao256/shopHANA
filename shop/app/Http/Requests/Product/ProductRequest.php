<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'thumb' => 'required',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'Please enter name product!',
            'thumb.required' => 'Image not empty!'
        ];
    }
}
