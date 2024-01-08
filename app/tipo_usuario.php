<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_usuario extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tipo_usuario';
    protected $primaryKey = 'ID_tipo_usuario';
    
    protected $fillable = [
        'TU_nombre',
        'ID_estado',
        'TU_fecha_creacion',

    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

}
