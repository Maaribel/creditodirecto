<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    protected $connection = 'mysql';
    protected $table = 'clientes';
    protected $primaryKey = 'ID_cliente';
    
    protected $fillable = [
        'ID_proyecto_macro',
        'ID_proyecto',
        'CL_nombre',
        'CL_rut',
        'CL_telefono',
        'CL_correo',
        'ID_estado',
        'ID_usuario_login',
        'CL_fecha_creacion' ,
        'CL_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function cliente_docx(){
        return $this->HasMany('App\adj_clientes','ID_cliente')->where('ID_estado', 1);
    }

    public function cliente_parcela(){
        return $this->HasMany('App\parcelas','ID_cliente')->whereIn('ID_estado', [1,3]);
    }



}
