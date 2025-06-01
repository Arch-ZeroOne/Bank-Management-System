<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class InsertCustomerRequest extends FormRequest
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
    'first_name'     => 'required',
    'last_name'      => 'required',
    'date_of_birth'  => 'required',
    'email'          => 'required',
    'phone_number'   => 'required',
    'address'        => 'required',
    'date_joined'    => 'required',
        ];
    }
}
