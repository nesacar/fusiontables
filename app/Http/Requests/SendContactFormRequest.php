<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendContactFormRequest extends FormRequest
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
            'email' => 'required',
            'message' => 'required',
            'profile' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Ime je obavezno',
            'email.required' => 'Email adresa je obavezna',
            'message.required' => 'Poruka je obavezna',
            'profile.required' => 'Profil je obavezan',
            'g-recaptcha-response.required' => 'Vi ste robot',
            'g-recaptcha-response.captcha' => 'Vi ste robot',
        ];
    }
}
