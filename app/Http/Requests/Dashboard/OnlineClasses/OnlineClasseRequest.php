<?php

namespace App\Http\Requests\Dashboard\OnlineClasses;

use Illuminate\Foundation\Http\FormRequest;

class OnlineClasseRequest extends FormRequest
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
            'grade_id' => 'required|exists:grades,id',
            'classe_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'meeting_topic' => 'required|string',
            'meeting_start_at' => 'required',
            // 'meeting_duration' => 'required|integer|max:60',
        ];
    }
}
