<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        $rules = $rulesAddress = $rulesCard = [];
        $rules = [
            'zip_code' => 'required',
            'street' => 'required|max:80',
            'number' => 'required|max:20',
            'neighborhood' => 'required|max:60',
            'complement' => 'nullable|max:40',
            'city' => 'required|min:2|max:60',
            'state' => 'required|max:2',
            'shipping_type' => 'required',
            'shipping_price' => 'required',
            'delivery_time' => 'required|integer',
            'payment_method' => 'required',
        ];

        if (request()->input('payment_method') == 'credit_card') {
            $rulesCard = [
                'holder_name' => 'required|max:50',
                'cpf_holder' => 'required',
                'birthdate' => 'required',
                'number_card' => 'required',
                'brand' => 'required',
                'expiration_month' => 'required',
                'expiration_year' => 'required',
                'cvv' => 'required',
            ];

            if (request()->input('isBilling') == 0) {
                $rulesAddress = [
                    'zip_code_billing' => 'required',
                    'street_billing' => 'required|max:80',
                    'number_billing' => 'required|max:20',
                    'neighborhood_billing' => 'required|max:60',
                    'complement_billing' => 'nullable|max:40',
                    'city_billing' => 'required|min:2|max:60',
                    'state_billing' => 'required|max:2',
                ];
            }
        }
        $mainRules = array_merge(
            $rules,
            $rulesCard,
            $rulesAddress,
        );
        return $mainRules;
    }
}
