<?php

namespace iBeaconProject\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class iBeaconguidanceUpdate extends FormRequest
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
            'id' => 'required|integer',
            'name' => 'required',
            'title' => 'required',
            'mac_address' => 'required',
            'link' => 'required'
        ];
    }
}