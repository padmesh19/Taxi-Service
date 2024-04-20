<?php

namespace App\Http\Requests;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = $this->route('user');
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . $userId],
            'phone' => ['required', 'numeric'],
            'role_id' => ['required', 'int', 'exists:roles,id'],
        ];
    }
}
