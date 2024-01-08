<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comp_pago extends Model
{
    protected $connection = 'mysql';
    protected $table = 'comp_pago';
    protected $primaryKey = 'ID_comp_pago';
    
    protected $fillable = [
        'CP_nombre',
        'CP_color',
        'ID_estado',
        'ID_usuario_login',
        'CP_fecha_creacion',
        'CP_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }


}
