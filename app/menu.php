<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $connection = 'mysql';
    protected $table = 'menu';
    protected $primaryKey = 'ID_menu';
    
    protected $fillable = [
        'M_nombre',
        'ID_estado',
        'ID_usuario_login',
        'M_fecha_creacion' ,
        'M_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function submenus(){
        return $this->hasMany('App\submenu','ID_menu');
    }


}
