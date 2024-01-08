<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class usuarios extends Authenticatable
{
    use Notifiable;
    protected $connection = 'mysql';
    protected $table = 'usuarios';
    protected $primaryKey = 'ID_usuario';
    protected $fillable = [
        'U_rut',
        'U_nombres',
        'U_apellidos',
        'U_correo',
        'U_nombre_usuario',
        'U_contrasena',
        'ID_area',
        'ID_tipo_usuario',
        'U_cambiar_contrasena',
        'U_fecha_expira',
        'U_dias_expira',
        'U_intentos',
        'ID_estado',
        'U_descripcion',
        'U_fecha_creacion',
        'U_fecha_actualizacion',
        
       
    ];

    protected $hidden = [
        'U_contrasena',
    ];
    
    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->U_contrasena;
    }

    public function estado_us(){
        return $this->belongsTo('App\estados','ID_estado');
    }
    
    public function tipo_usuario(){
        return $this->belongsTo('App\tipo_usuario','ID_tipo_usuario');
    }

    public function area(){
        return $this->belongsTo('App\area','ID_area');
    }

    public function submenus(){
        return $this->belongsToMany('App\submenu','usuario_submenu','ID_usuario','ID_submenu');
    }

    
}
