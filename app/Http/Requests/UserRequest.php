<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:15',
            'dob' => 'nullable|date',
            'age' => 'nullable|integer|min:0', 
            'city' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'roles' => 'required', 
        ];
    
        if ($this->isMethod('put')) {
            $rules['password'] = 'nullable';
            $rules['email'] = 'required|string|email|max:255';
        }
    
        return $rules;
    }

    public function messages() {
        return [
            'name.required' => 'User Name is required!',
            'password.min' => 'Password should have at least 8 characters.',
            'profile_picture.image' => 'The profile picture must be an image.',
            'profile_picture.mimes' => 'The profile picture must be a file of type: jpeg, png, jpg.',
            'profile_picture.max' => 'The profile picture may not be greater than 2MB.',
        ];
    }
}
