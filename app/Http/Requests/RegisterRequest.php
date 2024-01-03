<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role_id' => ['required', 'string'],
            'username' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:'. User::class],
            'phone_number' => ['required', 'string', 'min:11', 'unique:'. User::class],
            'address' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Get an error message for the defined validation rules.
     */
    public function messages(): array {
        return [
            'role_id.required' => 'Role ID is required, cannot be empty!',
            'username.required' => 'Username is required, cannot be empty!',
            'name.required' => 'Name is required, cannot be empty!',
            'email.required' => 'Email is required, cannot be empty!',
            'phone_number.required' => 'Phone Number is required, cannot be empty!',
            'address.required' => 'Address is required, cannot be empty!',
            'password.required' => 'Password is required, cannot be empty!',
        ];
    }
}
