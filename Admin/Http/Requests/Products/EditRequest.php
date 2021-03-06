<?php

namespace Bitaac\Admin\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => ['required', 'max:100'],
            'item_id'     => ['required', 'integer'],
            'count'       => ['required'],
            'points'      => ['required'],
            'description' => ['max:150'],
        ];
    }
}
