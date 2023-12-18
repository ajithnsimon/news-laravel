<?php

namespace App\Modules\UserPreference\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserPreferenceRequest
 *
 * @package App\Modules\UserPreference\Requests
 */
class UserPreferenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // You can define authorization logic here if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sources' => 'array',
            'authors' => 'array',
            'categories' => 'array',
            'sources.*' => 'integer|exists:sources,id',
            'authors.*' => 'integer|exists:authors,id',
            'categories.*' => 'integer|exists:categories,id'
        ];
    }

    /**
     * Get custom attributes for validation errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'sources' => 'source identifiers',
            'authors' => 'author identifiers',
            'categories' => 'category identifiers',
            // Add other custom attributes as needed
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sources.array' => 'The sources must be an array.',
            'authors.array' => 'The authors must be an array.',
            'categories.array' => 'The categories must be an array.',
            'sources.*.integer' => 'Each source identifier must be an integer.',
            'authors.*.integer' => 'Each author identifier must be an integer.',
            'categories.*.integer' => 'Each category identifier must be an integer.',
            // Add other custom messages as needed
        ];
    }
}
