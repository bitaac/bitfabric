<?php

namespace Bitaac\Admin\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'       => ['required', 'max:100', 'unique:__bitaac_store_products'],
            'item_id'     => ['required', 'integer'],
            'amount'      => ['required'],
            'points'      => ['required'],
            'description' => ['max:150'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
