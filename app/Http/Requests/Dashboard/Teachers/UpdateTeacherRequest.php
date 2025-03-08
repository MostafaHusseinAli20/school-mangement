<?php

namespace App\Http\Requests\Dashboard\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            'email' => 'sometimes|email|unique:teachers,email,' . $this->id,
            'password' => 'nullable|min:8',
            'name_teacher_ar' => 'sometimes|string|max:255',
            'name_teacher_en' => 'sometimes|string|max:255',
            'joining_data' => 'sometimes|date',
            'address' => 'sometimes|string|max:500',
            'gender_id' => 'sometimes|integer|exists:genders,id',
            'specialist_id' => 'sometimes|integer|exists:specialisations,id',
        ];
    }
}
