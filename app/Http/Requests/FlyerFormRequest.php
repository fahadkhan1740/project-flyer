<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FlyerFormRequest extends Request
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
            'street' => 'required',
            'city' => 'required',
            'zip' => 'required|integer',
            'country' => 'required',
            'state' => 'required',
            'price' => 'required|integer',
            'description' => 'required'
        ];
    }
}
