<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estado_transfer extends Model
{
    protected $connection = 'mysql';
    protected $table = 'estado_transfer';
    protected $primaryKey = 'ID_estado_transfer';
    
    protected $fillable = [
        'ETF_nombre',
        'ETF_color',
        'ECH_descripcion',
        'ID_estado',
        'ID_usuario_login',
        'ETF_fecha_creacion',
        'ETF_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }


}
