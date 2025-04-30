<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'order_id' => 'nullable|exists:orders,id',
            'payment_method' => 'required|string|in:Visa_card,Meeza_card,Master_card,Vodafone_cash',
            'card_number' => 'required_if:payment_method,Visa_card,Meeza_card,Master_card|string|max:16',
            'expiry_date' => [
            'required_if:payment_method,credit_card,debit_card',
            'string',
            'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/',
            ],
            'security_code' => 'required_if:payment_method,credit_card,debit_card|string',
            'phone_number' => 'nullable|string',
            'address' => 'required|string',
            'total_price' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'expiry_date.regex' => 'The expiry date must be in MM/YY format.',
            'card_number.max' => 'The card number must not exceed 16 characters.',
            'address.required' => 'A delivery address is required.',
        ];
    }
}