<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
        ];
        if(!request()->has('document_id')){
            $rules['file'] = 'required|mimes:rar,pdf,xlsx,xls,ppt,pptx,doc,docx,otp,odp,ods,odt,pps,psd,jpeg,jpg,png';
        }
        return $rules;
    }
}
