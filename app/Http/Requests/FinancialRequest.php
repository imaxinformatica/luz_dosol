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
        return [
            'bank_code' => 'required',
            'agency' => 'required',
            'account' => 'required',
            'account_type' => 'required',
            'cpf_holder' => 'required',
            'name_holder' => 'required'
        ];
    }
}
