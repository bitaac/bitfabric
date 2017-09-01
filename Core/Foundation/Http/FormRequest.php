<?php

namespace Bitaac\Core\Foundation\Http;

use Illuminate\Foundation\Http\FormRequest as Base;

class FormRequest extends Base
{
    /**
     * Overide and/or add new validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'in_config_key'  => 'in_config_key validation error',
            'in_config'      => 'in_config validation error',
        ];
    }
}
