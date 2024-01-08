<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parcelas_lista_ldm extends Model
{
    protected $connection = 'mysql';
    protected $table = 'parcelas_lista_ldm';
    protected $primaryKey = 'ID_parcelas_lista_ldm';
    
    protected $fillable = [
        'PLM_nombre',
        'PLM_valor_lista',
        'PLM_descuento',
        'PLM_valor_venta',
        'ID_estado',
        'ID_usuario_login',
        'PLM_fecha_creacion',
        'PLM_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function parcelasldm_simldm(){
        return $this->hasMany('App\simulador_ldm','ID_parcela_lista')->where('ID_Estado',1);
    }


}
