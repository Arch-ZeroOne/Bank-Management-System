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
    public function rules(): array
    {
        return [
            "acc-id" => 'required',
            "acc-number" => "required",
            "acc-plans" => "required",
            "initial-balance" => "nullable",
            "opened-date" => "required",
            "status" => "required",
            "customer_id" => ["required","unique:accounts","min:5", "max:5"]
        ];
    }
}
