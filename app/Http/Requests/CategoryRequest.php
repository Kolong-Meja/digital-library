<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'meta_title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'meta_description' => ['required', 'string'],
        ];
    }

     /**
     * Get an error message for the defined validation rules.
     */
    public function messages(): array {
        return [
            'name.required' => 'Name is required, cannot be empty!',
            'meta_title.required' => 'Meta title is required, cannot be empty!',
            'description.required' => 'Description is required, cannot be empty!',
            'meta_description.required' => 'Meta description is required, cannot be empty!',
        ];
    }
}
