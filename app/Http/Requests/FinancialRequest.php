<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialRequest extends FormRequest
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
        if(validateRequest('type') || \validateRequest('key')){
            $type = 'required';
            $key = 'required';
        }else{
            $type = 'nullable';
            $key = 'nullable';
        }
        return [
            'bank_code' => 'required',
            'agency' => 'required',
            'account' => 'required',
            'account_type' => 'required',
            'cpf_holder' => 'required',
            'type' => $type,
            'key' => $key,
            'name_holder' => 'required'
        ];
    }
}
