<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadPdfRequest extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Pdf je obavezan',
            'file.mimes' => 'Fajl nije u pdf formatu',
            'file.max' => 'Fajl je preko 1 MB',
        ];
    }
}
