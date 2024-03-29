<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmenityRequest extends FormRequest
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
                'name' =>  'required|string:200|unique:amenities,name',
            ];
        }
        if ($this->method() == 'PATCH') {
            return [
                // 'name' =>  'required|string:100|unique:amenities,name',
            ];
        }
        return [];
    }
}
