<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Please fill this field!',
            'email' => 'This field must be Email!',
            'unique' => 'Please select another :attribute!',
            'min' => ':attribute must be 8-16 characters!',
            'max' => ':attribute must be 8-16 characters!',
        ];
    }
}
