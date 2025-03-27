<?php

namespace App\Http\Requests\Dashboard\Subjects;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'classe_id' => 'required|exists:classes,id',
            'teacher_id' => 'required|exists:teachers,id',
        ];
    }
}
