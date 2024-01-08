<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class simulador extends Model
{
    protected $connection = 'mysql';
    protected $table = 'simulador';
    protected $primaryKey = 'ID_simulador';
    
    protected $fillable = [
        'S_nom_parcela',
        'S_nombre_cliente',
        'S_valor_parcela_uf',
        'S_uf_hoy',
        'S_fecha_uf_dia',
        'S_valor_parcela',
        'S_reserva',
        'S_pie',
        'S_compraventa',
        'S_fecha_inicio_credito',
        'S_dia_pago',
        'S_fecha_ultima_cuota',
        'S_cupo_otorgado',
        'S_interes',
        'S_saldo',
        'S_cantidad_cheques',
        'ID_tasa_anual',
        'S_tasa_mensual',
        'S_valor_cuota',
        'ID_estado',
        'ID_usuario_login',
        'S_fecha_creacion' ,
        'S_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function cliente(){
        return $this->belongsTo('App\clientes','ID_cliente');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function tasa_anual(){
        return $this->belongsTo('App\tasa_anual_proy','ID_tasa_anual');
    }

      public function simulador_cuotas(){
        return $this->HasMany('App\cuotas_sim','ID_simulador')->where('ID_estado', 1);
    }


}
