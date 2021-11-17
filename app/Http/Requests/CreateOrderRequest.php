<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'computer' => 'required|max:255',
            'type' => 'required|max:255',
            'description' => 'required|max:2000',
            'level' => 'required|numeric',
            'picutre' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'promo' => 'max:100|numeric|min:0'
        ];
    }
}
