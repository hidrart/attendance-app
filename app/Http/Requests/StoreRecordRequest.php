<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecordRequest extends FormRequest
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
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'accuracy' => 'required|numeric',
            'photo' => 'required',
        ];
    }

    /**
     * Prepare the data before validation.
     */
    protected function prepareForValidation(): void
    {
        $raw = $this->input('photo');
        @list($type, $raw) = explode(';', $raw);
        @list(, $raw) = explode(',', $raw);

        $this->merge([
            'photo' => $raw,
        ]);
    }
}
