<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class simulador_ldm extends Model
{
    protected $connection = 'mysql';
    protected $table = 'simulador_ldm';
    protected $primaryKey = 'ID_simulador_ldm';
    
    protected $fillable = [
        'SLM_datos_cliente',
        'SLM_fecha_promesa',
        'SLM_fecha_promesa2',
        'SLM_valorufhoy',
        'ID_parcela_lista',
        'SLM_pie_solicitado',
        'SLM_monto_pie',
        'SLM_cupo_otorgado',
        'ID_ncuotas_uf',
        'SLM_interes_anual',
        'SLM_interes_mensual',
        'SLM_tipo_credito',
        'SLM_valor_cuota',
        'SLM_cuota_final',
        'SLM_monto_cuota_final',
        'ID_estado',
        'ID_usuario_login',
        'SLM_fecha_creacion' ,
        'SLM_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function cuotassldm(){
        return $this->belongsTo('App\cuotas_sldm','ID_cuotas_sldm')->where('ID_estado', 1);
    }

    public function parcelasldm(){
        return $this->belongsTo('App\parcelas_lista_ldm','ID_parcela_lista')->where('ID_estado', 1);
    }

    public function numcuotassldm(){
        return $this->belongsTo('App\ncuotas_uf','ID_ncuotas_uf')->where('ID_estado', 1);
    }

    public function simuladorldm_cuotasldm(){
        return $this->HasMany('App\cuotas_sldm','ID_simulador_ldm')->where('ID_estado', 1);
    }



}
