<?php

namespace Bitaac\Guild\Http\Requests\Guilds;

use Bitaac\Core\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => ['required', 'alpha_space', 'max_words:3', 'unique:guilds,name'],
            'leader' => ['required', 'owns_character', 'guildless'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
