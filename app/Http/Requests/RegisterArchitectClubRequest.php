<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterArchitectClubRequest extends FormRequest
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
            'name' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Ime je obavezno',
            'city.required' => 'Grad je obavezan',
            'country.required' => 'Država je obavezna',
            'phone.required' => 'Telefon je obavezan',
            'email.required' => 'Email adresa je obavezna',
            'email.email' => 'Email adresa nije u ispravnom formatu',
            'g-recaptcha-response.required' => 'Vi ste robot',
            'g-recaptcha-response.captcha' => 'Vi ste robot',
        ];
    }
}
