<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class submenu extends Model
{
    protected $connection = 'mysql';
    protected $table = 'submenu';
    protected $primaryKey = 'ID_submenu';
    
    protected $fillable = [
        'ID_menu',
        'SM_nombre',
        'SM_ruta',
        'ID_estado',
        'ID_usuario_login',
        'SM_fecha_creacion' ,
        'SM_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function menu(){
        return $this->belongsTo('App\menu','ID_menu');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function usuario(){
        return $this->belongsToMany('App\usuarios','usuario_submenu','ID_usuario','ID_submenu');
    }


}
