<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDriverRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            //'picture' => 'required',
            'gender' => 'required',
            'licence_type' => 'required',
            'licence_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Driver name is mandatory',
            'address.required' => 'Driver address is mandatory',
            //'picture.required' => 'You need a profile picture',
            'gender.required' => 'Gender info is mandatory',
            'licence_type' => 'Driver licence type required (Ex: A,B,C...)',
            'licence_date' => 'We must know when the driver licence was obtained'
        ];
    }
}
