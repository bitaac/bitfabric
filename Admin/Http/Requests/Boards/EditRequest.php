<?php

namespace Bitaac\Admin\Http\Requests\Boards;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'       => ['required', 'max:50'],
            'order'       => ['digits_between:0,2'],
            'description' => ['max:150'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
