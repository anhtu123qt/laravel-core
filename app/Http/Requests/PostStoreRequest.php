<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\PseudoTypes\True_;

class PostStoreRequest extends FormRequest
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
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'Title',
            'body' => 'Content',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Please fill this field!',
        ];
    }
}
