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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'first_name' => 'required|string:30',
                'last_name' => 'required|string:30',
                'user_name' => 'required|unique:users,user_name',
                'gender' => 'required|string:30',
                'password' => 'required',
            ];
        }
        if ($this->method() == 'PATCH') {
            return [
                'first_name' => 'required|string:30',
                'last_name' => 'required|string:30',
                'gender' => 'required|string:30',
            ];
        }
        return [];
    }
}
