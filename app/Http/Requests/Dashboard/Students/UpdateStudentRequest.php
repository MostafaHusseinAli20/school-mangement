<?php

namespace App\Http\Requests\Dashboard\Students;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'email' => 'sometimes|email|unique:students,email,' . $this->id,
            'password' => 'nullable|min:8',
            'name_student_ar' => 'sometimes|string',
            'name_student_en' => 'sometimes|string',
            'date_birth' => 'sometimes|date',
            'academic_year' => 'sometimes',
            'gender_id' => 'sometimes|exists:genders,id',
            'nationality_id' => 'sometimes|exists:nationalities,id',
            'type_blood_id' => 'sometimes|exists:type_bloods,id',
            'grade_id' => 'sometimes|exists:grades,id',
            'classe_id' => 'sometimes|exists:classes,id',
            'section_id' => 'sometimes|exists:sections,id',
            'parent_id' => 'sometimes|exists:my_parents,id'
        ];
    }
}
