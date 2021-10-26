<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyStoreRequest extends FormRequest
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
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'email' => 'required|email|unique:companies,email,'.$this->id,
                'name' => 'required|string|max:50',
                'website' => 'required',
            ];
        }else {
            return [
                'email' => 'required|email|unique:companies',
                'name' => 'required|string|max:50',
                'website' => 'required',
                'logo' => 'required|mimes:jpeg,png,bmp,tiff,svg|dimensions:min_width=100,min_height=100'
            ];
        }
    }

    public function messages()
    {
        return [
            'logo.mimes' => 'Logo only jpeg, png, bmp,tiff,svg files are allowed.',
            'logo.dimensions' => 'Logo minimum 100 X 100.',
        ];
    }
}
