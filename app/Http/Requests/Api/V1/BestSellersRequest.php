<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BestSellersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Allow all users to make this request
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'age-group' => 'nullable|string|max:255', // Age group must be a string
            'author' => 'nullable|string|max:255', // Author must be a string
            'isbn' => 'nullable|string|regex:/^(\d{10}|\d{13})(;\d{10}|\d{13})*$/', // ISBN must be 10 or 13 digits, separated by semicolons
            'offset' => 'nullable|integer|min:0|multiple_of:20', // Offset must be a multiple of 20
            'title' => 'nullable|string|max:255', // Title must be a string
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'age-group.string' => 'The age group must be a string.',
            'author.string' => 'The author must be a string.',
            'isbn.regex' => 'The ISBN must be a 10 or 13-digit number, separated by semicolons.',
            'offset.integer' => 'The offset must be an integer.',
            'offset.multiple_of' => 'The offset must be a multiple of 20.',
            'title.string' => 'The title must be a string.',
        ];
    }
}