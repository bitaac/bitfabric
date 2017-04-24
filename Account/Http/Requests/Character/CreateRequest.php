<?php

namespace Bitaac\Account\Http\Requests\Character;

use Bitaac\Core\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'     => ['required', 'between:3,20', 'charname', 'blacklisted', 'unique:players,name'],
            'gender'   => ['required', 'in_config:bitaac.character.create-genders'],
            'vocation' => ['required', 'in_config:bitaac.character.create-vocations'],
            'town'     => ['required', 'in_config:bitaac.character.create-towns'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
