<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historial extends Model
{
    protected $connection = 'mysql';
    protected $table = 'historial';
    protected $primaryKey = 'ID_historial';
    
    protected $fillable = [
        'ID_usuario',
        'H_accion',
        'H_fecha_creacion' ,
        
    ];
    public $timestamps = false;

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario');
    }


}
