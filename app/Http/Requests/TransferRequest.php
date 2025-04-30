<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
            'to' => ['required', 'min:9', 'numeric'],
            'amount' => 'required|integer',
            'note' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'to.required' => 'Please fill the phone number',
            'to.min' => 'The phone number must be at least 9',
            'to.max' => 'The phone number must not be grater than 15',
            'to.numeric' => 'The phone number must be a number',
            'amount.required' => 'Please fill the amount',
            'note.required' => 'Please fill the some note'
        ];
    }
}
