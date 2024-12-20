<?php

namespace App\Http\Requests;

use App\Enums\TransactionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTransactionRequest extends FormRequest
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
            'amount' => 'required|numeric|min:0.01|max:99999999.99',
            'type' => ['required', new Enum(TransactionType::class)],
            'description' => 'nullable|string',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'amount.max' => 'The amount exceeds the allowed limit.',
            'amount.numeric' => 'The amount must be a valid number.',
        ];
    }
}
