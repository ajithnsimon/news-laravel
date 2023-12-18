<?php

namespace App\Modules\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Modules\Auth\Requests
 *
 * @property string $email
 * @property string $password
 */
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // The authorize method is used to determine if the user is authorized to make this request.
        // In this case, it always returns true, but you can add custom authorization logic if needed.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // The rules method defines the validation rules for the request parameters.
        // In this example, the 'email' field is required, must be a valid email address,
        // and must exist in the 'users' table. The 'password' field is also required.
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.exists' => 'The selected email is invalid or not registered.',
            'password.required' => 'The password field is required.',
        ];
    }
}
