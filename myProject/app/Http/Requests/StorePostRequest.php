<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est obligatoire',
            'title.min' => 'Le titre doit contenir au moins :min caractères',
            'title.max' => 'Le titre ne peut pas dépasser :max caractères',
            'content.required' => 'Le contenu est obligatoire',
            'content.min' => 'Le contenu doit contenir au moins :min caractères',
        ];
    }
}
