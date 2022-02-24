<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->route()->getName() == 'user.update') {
            $id = request()->segment(2);
            return [
                'name' => 'required',
                'email' => 'nullable|email|unique:users,email,' . $id . ',id',
                'password' => 'nullable|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'password_confirmation' => 'nullable',
                'role_id' => 'required|integer|not_in:0',
                'is_active' => 'required|in:0,1',
            ];

        }
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => 'required',
            'role_id' => 'required|integer|not_in:0',
            'is_active' => 'required|in:0,1',
        ];
    }
}
