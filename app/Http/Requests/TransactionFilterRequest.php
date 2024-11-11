<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionFilterRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'type' => 'nullable|in:deposit,withdrawal',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'user_id.exists' => 'The specified user ID does not exist.',
            'type.in' => 'The transaction type must be either deposit or withdrawal.',
            'from_date.date' => 'The from date must be a valid date.',
            'to_date.date' => 'The to date must be a valid date.',
            'to_date.after_or_equal' => 'The to date must be equal to or after the from date.',
        ];
    }
}
