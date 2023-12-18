<?php

namespace App\Modules\Article\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ArticleRequest
 *
 * @package App\Modules\Article\Requests
 */
class ArticleRequest extends FormRequest
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
            'search' => 'nullable|string',
            'sources' => 'nullable|array',
            'sources.*' => 'integer|exists:sources,id',
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id',
            'authors' => 'nullable|array',
            'authors.*' => 'integer|exists:authors,id',
            'date' => 'nullable|date',
            // Add other validation rules as needed
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
            'search' => 'search keyword',
            'sources' => 'source identifiers',
            'categories' => 'category identifiers',
            'authors' => 'author identifiers',
            'date' => 'article date',
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
            'sources.*.exists' => 'Invalid source identifier provided.',
            'categories.*.exists' => 'Invalid category identifier provided.',
            'authors.*.exists' => 'Invalid author identifier provided.',
            // Add other custom messages as needed
        ];
    }
}