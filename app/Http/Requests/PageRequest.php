<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'page_id' => 'required',
            'name' => 'required|max:100',
            'slug' => [
                'required',
                Rule::unique('pages')->ignore($this->request->get('page_id'), 'id'),
            ],
            'meta_title' => 'required|max:100',
            'meta_description' => 'required',
            'content' => 'required',
        ];
    }
}
