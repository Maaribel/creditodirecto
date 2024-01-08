<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cheques_reb extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cheques_reb';
    protected $primaryKey = 'ID_cheque_reb';
    
    protected $fillable = [
        'ID_cheque',
        'CR_monto_cheque',
        'ID_proyecto',
        'ID_proyecto_macro',
        'CR_fecha_rebote',
        'ID_estado',
        'ID_usuario_login',
        'CR_fecha_creacion' ,
        'CR_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }


}
