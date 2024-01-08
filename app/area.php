<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    protected $connection = 'mysql';
    protected $table = 'area';
    protected $primaryKey = 'ID_area';
    
    protected $fillable = [
        'A_nombre',
        'A_descripcion',
        'ID_estado',
        'ID_usuario_login',
        'A_fecha_creacion' ,
        'A_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }


}
