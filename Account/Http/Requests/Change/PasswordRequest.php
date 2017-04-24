<?php

namespace Bitaac\Account\Http\Requests\Change;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'password' => ['required', 'confirmed', 'min:6'],
            'current'  => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
