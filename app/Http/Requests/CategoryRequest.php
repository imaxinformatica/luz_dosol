<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $rules =  [
            'name' => 'required',
        ];
        if(request()->has('category_id')){
            $rules['slug'] = [
                'required',
                Rule::unique('categories')->ignore(request()->input('category_id')),
            ];
        }else{
            $rules['slug'] = 'required|unique:categories,slug';
        }
        return $rules;
    }
}
