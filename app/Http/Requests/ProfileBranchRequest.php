<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileBranchRequest extends FormRequest
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
                'branch_contact_person'=>'required|string:100',
                'branch_phone' => 'required|string:30',
                'branch_email' => 'required|email',
                'branch_address'=>'required|string',
                'branch_state_id'=>'required|integer',
                'branch_city_id'=>'required|integer',
                'branch_postcode'=>'required|integer',
                'branch_latitude' => 'required|string:100',
                'branch_longitude' => 'required|string:100',
            ];
        }
        if ($this->method() == 'PATCH') {
            return [
                'branch_contact_person'=>'required|string:100',
                'branch_phone' => 'required|string:30',
                'branch_email' => 'required|email',
                'branch_address'=>'required|string',
                'branch_state_id'=>'required|integer',
                'branch_city_id'=>'required|integer',
                'branch_postcode'=>'required|integer',
                'branch_latitude' => 'required|string:100',
                'branch_longitude' => 'required|string:100',
            ];
        }
        return [];
    }
}
