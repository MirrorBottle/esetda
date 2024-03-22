<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'name'    => [
                'required',
            ],
            'username'   => [
                'required',
                'unique:users,username,' . $this->user->id
            ],
            'email'   => [
                'required',
                'unique:users,email,' . $this->user->id
            ],
            'roles.*' => [
                'integer',
            ],
            'roles'   => [
                'required',
                'array',
            ],
        ];
    }
}
