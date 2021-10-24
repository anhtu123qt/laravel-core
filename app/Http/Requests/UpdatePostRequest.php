<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'Title',
            'body' => 'Content',
            'image' => 'Image',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Please fill this field!',
            'image' => 'Please select a image',
        ];
    }
}
