<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => ['required', 'max:255', 'string'],
            'email' => [
                'nullable',
                Rule::unique('users')->ignore($this->user->id, 'id'),
                'email',
            ],
            'password' => ['nullable', 'max:25', 'min:8', 'password'],
            'profile_image' => ['max:255', 'url'],
            'roles' => 'array',
        ];
    }
}
