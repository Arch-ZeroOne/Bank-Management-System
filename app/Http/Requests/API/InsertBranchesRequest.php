<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class InsertBranchesRequest extends FormRequest
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
    'branch_name' => 'required',
    'address' => 'required',
    'city' => 'required',
    'state' => 'required',
    'zip_code' => 'required',
        ];
    }
}
