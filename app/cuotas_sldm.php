<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cuotas_sldm extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cuotas_sldm';
    protected $primaryKey = 'ID_cuotas_sldm';
    
    protected $fillable = [
        'ID_simulador_ldm',
        'SCLM_nro_cuota',
        'SCLM_fecha_vencimiento',
        'SCLM_valor_cuota',
        'SCLM_saldo_ini',
        'SCLM_capital',
        'SCLM_interes',
        'SCLM_abono',
        'ID_estado',
        'ID_usuario_login',
        'SCLM_fecha_creacion' ,
        'SCLM_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function simuladorldm(){
        return $this->belongsTo('App\simulador_ldm','ID_simulador_ldm');
    }


}
