<?php

namespace App\Http\Requests;

class GuestCreateRequest extends BaseRequest
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
            'name' => 'required|string',
            'phone' => 'required|string|phone|unique:guests,phone',
            'surname' => 'required|string',
            'email' => 'string|email|unique:guests,email',
            'country' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.phone' => 'Incorrect phone number'
        ];
    }
}
