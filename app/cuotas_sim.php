<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cuotas_sim extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cuotas_sim';
    protected $primaryKey = 'ID_cuota_sim';
    
    protected $fillable = [
        'ID_simulador',
        'CTS_nro_cuota',
        'CTS_fecha_vencimiento',
        'CTS_valor_cuota',
        'CTS_saldo_ini',
        'CTS_capital',
        'CTS_interes',
        'CTS_saldo',
        'ID_estado',
        'ID_usuario_login',
        'CTS_fecha_creacion' ,
        'CTS_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function simulador(){
        return $this->belongsTo('App\simulador','ID_simulador');
    }


}
