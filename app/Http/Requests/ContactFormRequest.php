<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'project_type' => ['required', 'string', 'in:new,modernization,consulting,other'],
            'availability' => ['nullable', 'string', 'in:morning,afternoon,evening,flexible'],
            'message' => ['required', 'string', 'max:500'],
            'cf-turnstile-response' => app()->isProduction() ? ['required', 'string'] : ['nullable', 'string'],
        ];
    }
}
