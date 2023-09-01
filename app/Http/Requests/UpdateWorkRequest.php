<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required',
            'pic' => 'required|string|in:Listrik,Bengkel,Production',
            'plant' => 'required|string',
            'registration' => 'required|string|exists:works,registration',
            'classification' => 'required|string',
            'parameter' => 'required|string',
            'wo' => 'nullable|string',
            'jpp' => 'nullable|string',
            'notification' => 'nullable|string',
            'equipment' => 'required|string',
            'frequency' => 'required|string|in:Rutin,Tahunan',
            'value' => 'nullable|string',
        ];
    }
}
