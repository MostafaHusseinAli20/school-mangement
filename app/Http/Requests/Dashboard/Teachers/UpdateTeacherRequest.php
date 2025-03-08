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
            'email' => 'nullable|email',
            'password' => 'sometimes|nullable|min:8',
            'name_teacher_ar' => 'nullable|string',
            'name_teacher_en' => 'nullable|string',
            'joining_data' => 'nullable|date',
            'address' => 'nullable|string',
            'gender_id' => 'nullable|integer|exists:genders,id',
            'specialist_id' => 'nullable|integer|exists:specialisations,id',
        ];
    }
}
