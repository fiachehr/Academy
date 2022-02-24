<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'prise' => 'required|numeric',
            'ts_expire' => 'required|date|after:now',
            'is_finished' => 'required|in:0,1',
            'is_active' => 'required|in:0,1',
        ];
    }
}
