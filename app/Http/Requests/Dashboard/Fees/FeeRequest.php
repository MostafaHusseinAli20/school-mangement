<?php

namespace App\Http\Requests\Dashboard\Fees;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
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
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'year' => 'required',
            'grade_id' => 'required|integer|exists:grades,id',
            'classe_id' => 'required|integer|unique:fees,classe_id,' . $this->id
        ];
    }
}
