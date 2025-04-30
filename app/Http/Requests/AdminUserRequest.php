<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => ['required', 'email', 'min:10', Rule::unique('admin_users', 'email')],
            'phone' => ['required', 'min:9', 'max:20', 'numeric', Rule::unique('admin_users', 'phone')],
            'password' => 'required|min:8'
        ];
    }
}
