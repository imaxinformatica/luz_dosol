<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommissionRequest extends FormRequest
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
           'commission_1' => 'required',
           'commission_2' => 'required',
           'commission_3' => 'required',
           'commission_4' => 'required',
           'commission_5' => 'required',
           'commission_6' => 'required',
           'commission_7' => 'required',
           'commission_8' => 'required',
           'commission_9' => 'required',
           'commission_10' => 'required',        
        ];
    }
}
