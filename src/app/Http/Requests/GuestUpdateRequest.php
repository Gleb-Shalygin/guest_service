<?php

namespace App\Http\Requests;


class GuestUpdateRequest extends BaseRequest
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
            'id' => 'required|integer|exists:guests,id',
            'name' => 'string',
            'phone' => 'required|string|phone',
            'surname' => 'string',
            'email' => 'string|email',
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
