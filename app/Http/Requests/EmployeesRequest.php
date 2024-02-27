<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeesRequest extends FormRequest
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
            'first_name' => ['required', 'max:25', 'alpha'],
            'last_name' => ['required', 'max:25', 'alpha'],
            'company_id' => ['required'],
            'email' => ['nullable', 'max:50', 'email'],
            'phone' => ['nullable', 'max:10', 'min:10'],
        ];
    }
}
