<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estado_cuota extends Model
{
    protected $connection = 'mysql';
    protected $table = 'estado_cuota';
    protected $primaryKey = 'ID_estado_cuota';
    
    protected $fillable = [
        'ECT_nombre',
        'ID_estado',
        'ID_usuario_login',
        'ECT_fecha_creacion',
        'ECT_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }


}
