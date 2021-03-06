<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'name' => 'required',
            'cpf' => 'required',
            'rg' => 'required',
            'cellphone' => 'required',
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'bank_code' => 'required',
            'agency' => 'required',
            'account' => 'required',
            'account_type' => 'required',
            'cpf_holder' => 'required',
            'name_holder' => 'required',

        ];
        if(validateRequest('type') || \validateRequest('key')){
            $rules['type'] = 'required';
            $rules['key'] = 'required';
        }else{
            $rules['type'] = 'nullable';
            $rules['key'] = 'nullable';
        }
        if ($this->request->has('user_id')) {
            $rules['password'] = ['required|min:6'];
            $rules['email'] = [
                'required',
                Rule::unique('users')->ignore($this->request->get('email'), 'email'),
            ];
        } else {
            $rules['email'] = [
                'required',
                Rule::unique('users'),
            ];
        }
        return $rules;
    }
}
