<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'role' => 'required|string', // this type is boolean in database, but in formData is string
            'name' => 'required|string|max:' . config('global.userNameLength'),
            'email' => 'required|string|email|max:' .  config('global.emailLength') . '|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }
}
