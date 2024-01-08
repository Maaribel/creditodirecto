<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parcelas extends Model
{
    protected $connection = 'mysql';
    protected $table = 'parcelas';
    protected $primaryKey = 'ID_parcela';
    
    protected $fillable = [
        'ID_proyecto_macro',
        'ID_proyecto',
        'PC_num_parcela',
        'PC_nombre',
        'PC_admin_ant',
        'ID_cliente',
        'PC_tipo_cambio',
        'PC_valor_uf_dia',
        'PC_fecha_uf',
        'PC_valor_parcela_uf',
        'PC_valor_parcela',
        'PC_forma_pago',
        'PC_promesa',
        'PC_reserva',
        'PC_pie',
        'PC_monto',
        'PC_inicio_credito',
        'PC_dia_pago',
        'PC_fecha_ultima_cuota',
        'PC_cupo_otorgado',
        'PC_cant_cheques',
        'PC_tasa_anual',
        'PC_tasa_mensual',
        'PC_valor_cuota',
        'ID_comp_pago',
        'PC_factura',
        'PC_alzamiento',
        'PC_cupo_otransf',
        'PC_cant_transf',
        'PC_fecha_inicio_transf',
        'PC_valor_transf',
        'PC_fecha_ultima_transf',
        'PC_tasa_anual_transf',
        'PC_tasa_mensual_transf',
        'ID_estado',
        'ID_usuario_login',
        'PC_fecha_creacion',
        'PC_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function cliente(){
        return $this->belongsTo('App\clientes','ID_cliente');
    }

     public function com_pago(){
        return $this->belongsTo('App\comp_pago','ID_comp_pago');
    }

    public function pc_proyecto(){
        return $this->belongsTo('App\proyectos','ID_proyecto');
    }

    public function cred_parcela(){
        return $this->belongsTo('App\parcelas','ID_proyecto')->where('PC_forma_pago', 1);
    }

    public function pc_cheque(){
        return $this->belongsTo('App\cheques','ID_parcela')->where('ID_estado', 1);
    }

    public function parcela_cheque(){
        return $this->HasMany('App\cheques','ID_parcela')->where('ID_estado', 1);
    }

    public function parcela_cuotas(){
        return $this->HasMany('App\cuotas','ID_parcela')->where('ID_estado', 1);
    }

    public function parcela_transferencias(){
        return $this->HasMany('App\transferencias','ID_parcela')->where('ID_estado', 1);
    }

    public function parcela_transfer_pag(){
        return $this->HasMany('App\transferencias','ID_parcela')->where('ID_estado', 1)->where('ID_estado_transfer', 2);
    }

    public function parcela_transfer_atr(){
        return $this->HasMany('App\transferencias','ID_parcela')->where('ID_estado', 1)->where('ID_estado_transfer', 3);
    }

     public function parcela_cuotas_pagadas(){
        return $this->HasMany('App\cuotas','ID_parcela')->where('ID_estado', 1)->where('ID_estado_cuota', 3);
    }

    public function parcela_cuotas_morosas(){
        return $this->HasMany('App\cuotas','ID_parcela')->where('ID_estado', 1)->where('ID_estado_cuota', 2);
    }

    public function parcela_cheque_pag(){
        return $this->HasMany('App\cheques','ID_parcela')->where('ID_estado', 1)->where('ID_estado_cheque', 4);
    }

    public function parcela_cheque_atr(){
        return $this->HasMany('App\cheques','ID_parcela')->where('ID_estado', 1)->where('ID_estado_cheque', 3);
    }


}
