<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ncuotas_uf extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ncuotas_uf';
    protected $primaryKey = 'ID_ncuotas_uf';
    
    protected $fillable = [
        'NC_cuotas',
        'NC_tasa_anual',
        'ID_estado',
        'ID_usuario_login',
        'NC_fecha_creacion' ,
        'NC_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }


}
