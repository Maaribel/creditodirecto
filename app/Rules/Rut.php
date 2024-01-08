<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Traits\TraitValidaRut;

class Rut implements Rule
{
    use TraitValidaRut;
    
    public function passes($attribute, $value)
    {
        return TraitValidaRut::comprueba($value);
    }


    public function message()
    {
        return 'El rut ingresado no es valido.';
    }
}

