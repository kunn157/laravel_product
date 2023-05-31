<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
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
        return [
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'user_name' => ['required', 'string', 'max:100','unique:users'],
            'birthday' => [ 'date','before:18 years'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'avatar' => 'mimes:jpeg,jpg,png|max:3072',
            'province_id' => ['required', 'string'],
            'district_id' => ['required', 'string'],
            'commune_id' => ['required', 'string'],
        ];
    }

}
