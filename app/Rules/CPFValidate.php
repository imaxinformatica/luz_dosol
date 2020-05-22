<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CPFValidate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $nameInput;
    public function __construct($nameInput)
    {
        $this->nameInput = $nameInput;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$value) {
            return false;
        }
        $cpf = preg_replace('/[^0-9]/is', '', $value);
        
        if (strlen($cpf) != 11) {
            return false;
        }
        if(
            $cpf == '00000000000' ||
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999'
            ){
            return false;
        }
        $digitos = substr($cpf, 0, 9);
        $novo_cpf = calc_digitos_posicoes($digitos);

        $novo_cpf = calc_digitos_posicoes($novo_cpf, 11);
        return $novo_cpf === $cpf;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "O número do {$this->nameInput} é inválido.";
    }
}
