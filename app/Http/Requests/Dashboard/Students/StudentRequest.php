<?php

namespace App\Http\Requests\Dashboard\Students;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:8',
            'name_student_ar' => 'required|string',
            'name_student_en' => 'required|string',
            'date_birth' => 'required|date',
            'academic_year' => 'required',
            'gender_id' => 'required|exists:genders,id',
            'nationality_id' => 'required|exists:nationalities,id',
            'type_blood_id' => 'required|exists:type_bloods,id',
            'grade_id' => 'required|exists:grades,id',
            'classe_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'parent_id' => 'required|exists:my_parents,id',
        ];
    }
}
