<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'country_code' => 'nullable|string|max:10',
            'mobile' => 'required|string|max:20|unique:users,mobile',
            'password' => 'required|string|min:8|confirmed',
            'whatsapp_no' => 'nullable|string|max:20',
            'profile_image' => 'nullable|string',
            'dob' => 'nullable|date',
            'employee_code' => 'nullable|string|max:100',
            'current_latitude' => 'nullable|numeric',
            'current_longitude' => 'nullable|numeric',
            'zone' => 'nullable|string|max:100',
            'referral_code' => 'nullable|string|max:100',
            'license_key' => 'nullable|string',
        ];
    }
    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'mobile.required' => 'Mobile number is required',
            'mobile.unique' => 'Mobile number already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
        ];
    }
}
