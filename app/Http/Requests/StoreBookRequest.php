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
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'published_date' => 'required|date',
            'is_available'   => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'          => 'The book title is required.',
            'author.required'         => 'The author name is required.',
            'published_date.required' => 'The published date is required.',
            'published_date.date'     => 'The published date must be a valid date.',
            'title.max'               => 'The book title cannot exceed 255 characters.',
            'author.max'              => 'The author name cannot exceed 255 characters.',
            'is_available.boolean'    => 'The availability field must be true or false.'
        ];
    }
}
