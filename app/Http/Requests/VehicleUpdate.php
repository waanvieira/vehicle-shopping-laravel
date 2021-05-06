<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleUpdate extends FormRequest
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
            'zipCode' => 'required',
            'city'    => 'required',
            'uf'      => 'required',
            'type'    => 'required',
            'brand'   => 'required',
            'model'   => 'required',
            'version' => 'required',
            'regdate' => 'required',
            'fuel'    => 'required',
            'price'   => 'required'
        ];
    }
}
