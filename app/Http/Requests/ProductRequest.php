<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;


class ProductRequest extends FormRequest
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
            'reference' => 'required',
            'name' =>'required|max:45',
            'description' => 'required|max:400',
            'price' => 'required',
            'category_id' => 'required',
            'weight' => 'required',
        ];

        if(Input::has('product_id')){
            $rules['file'] = 'nullable|mimes:jpeg,jpg,png,bmp';
            
            $rules['reference'] = [
                'required',
                Rule::unique('products')->ignore($this->request->get('reference'), 'reference'),
            ];
        }else{
            $rules['file'] = 'required|mimes:jpeg,jpg,png,bmp';
            $rules['reference'] = [
                'required',
                Rule::unique('products'),
            ];
        }
        return $rules;
    }
}
