<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cuotas_scla extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cuotas_scla';
    protected $primaryKey = 'ID_cuota_scla';
    
    protected $fillable = [
        'ID_simulador_cla',
        'CCLA_nro_cuota',
        'CCLA_fecha_vencimiento',
        'CCLA_valor_cuota',
        'CCLA_saldo_ini',
        'CCLA_capital',
        'CCLA_interes',
        'CCLA_saldo',
        'ID_estado',
        'ID_usuario_login',
        'CCLA_fecha_creacion' ,
        'CCLA_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function simuladorcla(){
        return $this->belongsTo('App\simuladorcla','ID_simulador_cla');
    }


}
