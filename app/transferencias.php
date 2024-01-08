<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transferencias extends Model
{
    protected $connection = 'mysql';
    protected $table = 'transferencias';
    protected $primaryKey = 'ID_transferencia';
    
    protected $fillable = [
        'TR_titular',
        'TR_monto',
        'TR_banco',
        'TR_cuenta',
        'TR_numero',
        'TR_fecha_deposito',
        'TR_comprobante',
        'ID_parcela',
        'ID_proyecto',
        'ID_proyecto_macro',
        'ID_estado',
        'ID_estado_transfer',
        'ID_usuario_login',
        'TR_fecha_creacion' ,
        'TR_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

     public function estadotransfer(){
        return $this->belongsTo('App\estado_transfer','ID_estado_transfer');
    }


}
