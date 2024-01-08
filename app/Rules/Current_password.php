<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Current_password implements Rule{

    public function passes($attribute, $value){
        return (Hash::check($value, Auth::user()->Usu_Contrasena)) ? false : true;
    }
    
    public function message(){
        return 'La contraseña no puede ser igual a la anterior.';
    }
}