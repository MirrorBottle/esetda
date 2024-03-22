<?php

namespace App\Http\Requests;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class PasswordDipositionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_disposition_password' => ['required', 'min:6'],
            'disposition_password' => ['required', 'min:6', 'confirmed', 'different:old_disposition_password'],
            'disposition_password_confirmation' => ['required', 'min:6'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'old_disposition_password' => ' Password Disposisi Saat Ini',
            'disposition_password' => 'Password Disposisi Baru',
            'disposition_password_confirmation' => 'Konfirmasi Password Disposisi Baru',
        ];
    }
}
