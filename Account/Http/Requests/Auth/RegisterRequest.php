<?php

namespace Bitaac\Account\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'account'  => ['required', 'between:4,23', 'alpha_num', 'unique:accounts,name'],
            'email'    => ['required', 'email', 'unique:accounts'],
            'password' => ['required', 'confirmed', 'min:6'],
            'terms'    => ['accepted'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
