<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historial_sesiones extends Model
{
    protected $connection = 'mysql';
    protected $table = 'historial_sesiones';
    protected $primaryKey = 'ID_historial_sesiones';
    
    protected $fillable = [
        'ID_usuario',
        'HS_fecha_conexion',
        'HS_fecha_desconexion',
        'HS_fecha_creacion' ,
        
    ];
    public $timestamps = false;

    public function usuario(){
        return $this->belongsTo('App\usuarios','ID_usuario');
    }


}
