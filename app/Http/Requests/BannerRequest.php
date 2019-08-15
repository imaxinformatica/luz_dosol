<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class BannerRequest extends FormRequest
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
            'description' => 'required|max:50',
            'status' => 'required',
        ];
        if(Input::has('link') && Input::get('link') != null || Input::has('target')){
            $rules['link'] = 'required';
            $rules['target'] = 'required';
        }
        if(Input::has('banner_id')){
            $rules['file'] = 'nullable|mimes:jpeg,bmp,png,jpg';
        }else{
            $rules['file'] = 'required|mimes:jpeg,bmp,png,jpg';
        }
        return $rules;
    }
}
