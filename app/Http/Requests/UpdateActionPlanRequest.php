<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActionPlanRequest extends FormRequest
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
            'photo' => 'nullable|image|max:2048',
            'plan' => 'required|string',
            'analysis' => 'required|string',
            'recommendation' => 'required|string',
            'status' => 'required|in:pending,ongoing,completed',
        ];
    }
}
