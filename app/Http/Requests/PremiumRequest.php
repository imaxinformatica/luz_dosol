<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PremiumRequest extends FormRequest
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
            'graduation' => 'required',
        ];
        if(request()->has('premium_id')){
            $rules['file'] = 'nullable|mimes:jpg,png,jpeg,bmp';
        }else{
            $rules['file'] = 'required|mimes:jpg,png,jpeg,bmp';
        }
        return $rules;
    }
}
