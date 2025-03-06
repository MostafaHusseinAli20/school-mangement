<?php

namespace App\Http\Requests\Dashboard\Sections;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'name_section' => 'required|string',
            'name_section_en' => 'required|string',
            'grade_id' => 'required|exists:grades,id',
            'classe_id' => 'required|exists:classes,id',
        ];
    }
}
