<?php

namespace App\Http\Requests\Dashboard\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|min:8',
            'name_teacher_ar' => 'required|string',
            'name_teacher_en' => 'required|string',
            'joining_data' => 'required|date',
            'address' => 'required|string',
            'gender_id' => 'required|integer|exists:genders,id',
            'specialist_id' => 'required|integer|exists:specialisations,id',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'name_teacher_ar.required' => trans('validation.required'),
            'name_teacher_en.required' => trans('validation.required'),
            'specialist_id.required' => trans('validation.required'),
            'gender_id.required' => trans('validation.required'),
            'address.required' => trans('validation.required'),
            'Address.required' => trans('validation.required'),
        ];
    }
}
