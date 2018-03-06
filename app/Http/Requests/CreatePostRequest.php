<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'short' => 'required',
            'body' => 'required',
            'category_id' => 'required|integer|min:1',
        ];
    }

    /*public function messages()
    {
        return [
            'title.required' => 'Naziv je obavezan',
            'short.required' => 'Kratak tekst je obavezan',
            'body.required' => 'Glavni tekst je obavezan',
        ];
    }*/
}
