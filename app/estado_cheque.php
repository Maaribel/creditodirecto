<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estado_cheque extends Model
{
    protected $connection = 'mysql';
    protected $table = 'estado_cheque';
    protected $primaryKey = 'ID_estado_cheque';
    
    protected $fillable = [
        'ECH_nombre',
        'ECH_color',
        'ECH_descripcion',
        'ID_estado',
        'ID_usuario_login',
        'ECH_fecha_creacion',
        'ECH_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }


}
