<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tasa_anual_proy extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tasa_anual_proy';
    protected $primaryKey = 'ID_tasa_anual';
    
    protected $fillable = [
        'TA_nom_proyecto',
        'TA_tasa_anual',
        'ID_estado',
        'ID_usuario_login',
        'TA_fecha_creacion' ,
        'TA_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }


}
