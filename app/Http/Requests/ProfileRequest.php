<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
                'profile_phone' => 'required|string:30',
                'profile_email' => 'required|email',
                'profile_org_name' => 'required|string:100',
            ];
        }
        if ($this->method() == 'PATCH') {
            return [
                'profile_phone' => 'required|string:30',
                'profile_email' => 'required|email',
                'profile_org_name' => 'required|string:100',
            ];
        }
        return [];
    }
}
