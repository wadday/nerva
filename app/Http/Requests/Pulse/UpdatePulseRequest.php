<?php

namespace App\Http\Requests\Pulse;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePulseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'song_id' => ['sometimes', 'integer', 'exists:songs,id'],
            'caption' => ['sometimes', 'string', 'nullable'],
            'selected_timestamp' => ['sometimes', 'numeric', 'nullable'],
            'allow_comments' => ['sometimes', 'boolean', 'nullable'],
            'status' => ['sometimes', 'string', 'nullable'],
            'visibility' => ['sometimes', 'string', 'nullable'],
        ];
    }
}
