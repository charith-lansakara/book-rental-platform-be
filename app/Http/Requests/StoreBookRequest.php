<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'is_available' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'  => 'The book title is required.',
            'author.required' => 'The author name is required.',
            'title.max'       => 'The book title cannot exceed 255 characters.',
            'author.max'      => 'The author name cannot exceed 255 characters.',
            'is_available.boolean' => 'The availability field must be true or false.'
        ];
    }
}
