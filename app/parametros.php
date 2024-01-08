<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parametros extends Model
{
    protected $connection = 'mysql';
    protected $table = 'parametros';
    protected $primaryKey = 'ID_parametro';
    
    protected $fillable = [
        'P_nivel_contrasena',
        'P_caduca_contrasena',
        'ID_estado',
        'ID_usuario_login',
        'P_fecha_creacion',
        'P_fecha_actualizacion',
        
    ];
    public $timestamps = false;


}
