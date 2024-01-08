<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proyectos_macro extends Model
{
    protected $connection = 'mysql';
    protected $table = 'proyectos_macro';
    protected $primaryKey = 'ID_proyecto_macro';
    
    protected $fillable = [
        'PRM_nombre',
        'ID_estado',
        'ID_usuario_login',
        'PRM_fecha_creacion',
        'PRM_fecha_actualizacion',
        
    ];
    public $timestamps = false;


}
