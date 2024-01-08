<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estados extends Model
{
    protected $connection = 'mysql';
    protected $table = 'estado';
    protected $primaryKey = 'ID_estado';
    
    protected $fillable = [
        'E_nombre',
        'E_fecha_creacion',
        
    ];
    public $timestamps = false;


}
