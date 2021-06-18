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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:6|regex:/^[A-ZŠĐČĆŽ]{1}[a-zšđčćž]{2,}\s[A-ZŠĐČĆŽ]{1}[a-zšđčćž]{2,}$/',
            'email' => 'required|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/',
            'current_password' => 'required',
            'password' => 'nullable|min:8|confirmed'
        ];
    }
}
