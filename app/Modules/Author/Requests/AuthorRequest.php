<?php

namespace App\Modules\Author\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AuthorRequest
 *
 * @package App\Modules\Author\Requests
 */
class AuthorRequest extends FormRequest
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
            'search' => 'nullable|string'
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
            'search' => 'search keyword'
            // Add other custom attributes as needed
        ];
    }
}