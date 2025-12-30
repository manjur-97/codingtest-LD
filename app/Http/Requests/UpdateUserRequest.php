<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'id'    => 'required|integer|exists:users,id',
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'id.exists'      => 'The selected user does not exist.',
            'name.required'  => 'Please enter the user name.',
            'name.string'    => 'The name must be a valid string.',
            'name.max'       => 'The name may not be greater than 255 characters.',
            'email.required' => 'Please enter the email address.',
            'email.email'    => 'Please provide a valid email address.',
            'email.unique'   => 'This email is already taken by another user.',
        ];
    }
}
