<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cheques extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cheques';
    protected $primaryKey = 'ID_cheque';
    
    protected $fillable = [
        'CHQ_titular',
        'CHQ_monto',
        'ID_cuota',
        'CHQ_banco',
        'CHQ_nro_cuenta',
        'CHQ_nro_serie',
        'CHQ_fecha_deposito',
        'CHQ_comprobante_dep',
        'CHQ_adjunto',
        'CHQ_adjunto_comp',
        'ID_parcela',
        'ID_proyecto',
        'ID_proyecto_macro',
        'ID_estado',
        'ID_estado_cheque',
        'ID_usuario_login',
        'CHQ_fecha_creacion' ,
        'CHQ_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function estado_chq(){
        return $this->belongsTo('App\estado_cheque','ID_estado_cheque');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

     public function cuota(){
        return $this->belongsTo('App\cuotas','ID_cuota');
    }


}
