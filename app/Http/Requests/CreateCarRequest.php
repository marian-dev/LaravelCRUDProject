<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
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
            'model' => 'required',
            'plate_number' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'model.required' => 'Modelul este obligatoriu',
            'plate_number.required' => 'Numarul de inmatriculare este obligatoriu',
        ];
    }
}
