<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class simulador_cla extends Model
{
    protected $connection = 'mysql';
    protected $table = 'simulador_cla';
    protected $primaryKey = 'ID_simulador_cla';
    
    protected $fillable = [
        'SCLA_nom_proyecto',
        'SCLA_nom_parcela',
        'SCLA_nom_cliente',
        'SCLA_valor_parcela_uf',
        'SCLA_uf_hoy',
        'SCLA_fecha_uf_dia',
        'SCLA_valor_parcela',
        'SCLA_reserva',
        'SCLA_pie',
        'SCLA_compraventa',
        'SCLA_fecha_inicio_credito',
        'SCLA_dia_pago',
        'SCLA_fecha_ultima_cuota',
        'SCLA_cupo_otorgado',
        'SCLA_interes',
        'SCLA_saldo',
        'SCLA_cantidad_cheques',
        'SCLA_tasa_anual',
        'SCLA_tasa_mensual',
        'SCLA_valor_cuota',
        'ID_estado',
        'ID_usuario_login',
        'SCLA_fecha_creacion' ,
        'SCLA_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

      public function simuladorcla_cuotascla(){
        return $this->HasMany('App\cuotas_scla','ID_simulador_cla')->where('ID_estado', 1);
    }


}
