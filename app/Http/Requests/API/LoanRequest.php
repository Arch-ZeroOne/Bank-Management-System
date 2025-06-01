<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'loan_type' => 'required',
            'principal_amount' => 'required',
            'interest_rate' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            'customer_id' => 'required',
        ];
    }
}
