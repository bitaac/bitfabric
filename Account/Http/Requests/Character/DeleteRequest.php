<?php

namespace Bitaac\Account\Http\Requests\Character;

use Bitaac\Core\Rules\OwnsCharacter;
use Bitaac\Core\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'character' => ['bail', 'required', 'exists:players,name', new OwnsCharacter],
            'password'  => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
