<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:20|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:10',
            'phone' => 'required|integer|digits:10',
            'address' => 'required|max:200|min:3',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
            'phone.required' => 'The phone number is required.',
            'address.required' => 'The address field is required.',
        ];

   }
}