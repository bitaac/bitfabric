<?php

namespace Bitaac\Account\Http\Requests\Character;

use Bitaac\Core\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'character' => ['required', 'exists:players,name', 'owns_character'],
            'password'  => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
