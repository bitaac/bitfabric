<?php

namespace Bitaac\Guild\Http\Requests\Guild;

use Bitaac\Core\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logo' => ['image', 'dimensions:max_width=250,max_height=250'],
            'description' => ['max:250'],
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
