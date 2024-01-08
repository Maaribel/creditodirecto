<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cuotas extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cuotas';
    protected $primaryKey = 'ID_cuota';
    
    protected $fillable = [
        'ID_parcela',
        'CT_nro_cuota',
        'ID_cliente',
        'CT_fecha_vencimiento',
        'CT_valor_cuota',
        'ID_estado_cuota',
        'CT_fecha_pago',
        'ID_estado',
        'ID_usuario_login',
        'CT_fecha_creacion' ,
        'CT_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function estado_cuota(){
        return $this->belongsTo('App\estado_cuota','ID_estado_cuota');
    }

    public function cliente(){
        return $this->belongsTo('App\clientes','ID_cliente');
    }

    public function parcela(){
        return $this->belongsTo('App\parcelas','ID_parcela');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }


}
