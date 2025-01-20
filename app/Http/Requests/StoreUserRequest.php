<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set this to true if you don't have any authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required|digits:10',
            'gender' => 'required|in:male,female,other',
            'address' => 'nullable|string',
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
