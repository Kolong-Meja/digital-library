<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

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
        return [
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:'. User::class],
            'phone_number' => ['required', 'string', 'unique:users,phone_number'],
            'address' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Get an error message for the defined validation rules.
     */
    public function messages(): array {
        return [
            'username.required' => 'Username is required, cannot be empty!',
            'name.required' => 'Name is required, cannot be empty!',
            'email.required' => 'Email is required, cannot be empty!',
            'phone_number.required' => 'Phone Number is required, cannot be empty!',
            'address.required' => 'Address is required, cannot be empty!',
            'password.required' => 'Password is required, cannot be empty!',
        ];
    }
}
