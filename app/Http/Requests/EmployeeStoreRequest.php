<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
                'company_id' => 'required',
                'email' => 'required|email|unique:employees,email,'.$this->id,
                'firstname' => 'required|string|max:50',
                'lastname' => 'required|string|max:50',
                'phone' => 'required|max:15'
            ];
        }else {
            return [
                'company_id' => 'required',
                'email' => 'required|email|unique:employees',
                'firstname' => 'required|string|max:50',
                'lastname' => 'required|string|max:50',
                'phone' => 'required|max:15'
            ];
        }
    }

    public function messages()
    {
        return [
            'company_id.required' => 'Please select company.',
        ];
    }
}
