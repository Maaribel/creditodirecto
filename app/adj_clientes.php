<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adj_clientes extends Model
{
    protected $connection = 'mysql';
    protected $table = 'adj_clientes';
    protected $primaryKey = 'ID_adj_cliente';
    
    protected $fillable = [
        'ID_cliente',
        'ACL_nombre',
        'ACL_ruta',
        'ID_estado',
        'ID_usuario_login',
        'ACL_fecha_creacion' ,
        'ACL_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }


}
