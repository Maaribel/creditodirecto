<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proyectos extends Model
{
    protected $connection = 'mysql';
    protected $table = 'proyecto';
    protected $primaryKey = 'ID_proyecto';
    
    protected $fillable = [
        'ID_proyecto_macro',
        'PR_nombre',
        'PR_descripcion',
        'PR_fecha_inicio_ventas',
        'PR_fecha_fin_ventas',
        'PR_total_unidades',
        'PR_ruta_master',
        'ID_estado',
        'ID_usuario_login',
        'PR_fecha_creacion',
        'PR_fecha_actualizacion',
        
    ];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo('App\estados','ID_estado');
    }

    public function usuariocrea(){
        return $this->belongsTo('App\usuarios','ID_usuario_login');
    }

    public function proy_parcela(){
        return $this->HasMany('App\parcelas','ID_proyecto')->whereIn('ID_estado', [1,3,4]);
    }
    
    public function proy_cliente(){
        return $this->belongsTo('App\clientes','ID_proyecto')->where('ID_estado', 1);
    }

    public function proy_cheques(){
        return $this->HasMany('App\cheques','ID_proyecto')->where('ID_estado', 1);
    }

    public function proy_parcela_f(){
        return $this->belongsTo('App\clientes','ID_proyecto')->where('ID_estado', 1);
    }

    public function proy_parcela_cont(){
        return $this->HasMany('App\parcelas','ID_proyecto')->whereIn('ID_estado', [1,3])->where('PC_forma_pago', 2);
    }

    public function proy_parcela_cd(){
        return $this->HasMany('App\parcelas','ID_proyecto')->whereIn('ID_estado', [1,3])->where('PC_forma_pago', 1);
    }

    public function proy_cheque_cd(){
        return $this->HasMany('App\cheques','ID_proyecto')->where('ID_estado', 1)->where('ID_estado_cheque', 4);
    }

    public function proy_transfer_cd(){
        return $this->HasMany('App\transferencias','ID_proyecto')->where('ID_estado', 1);
    }

    public function proy_cheque_reb(){
        return $this->HasMany('App\cheques_reb','ID_proyecto')->where('ID_estado', 1);
    }

    public function proy_cheque_reb_real(){
        return $this->HasMany('App\cheques','ID_proyecto')->where('ID_estado', 1)->where('ID_estado_cheque', 3);
    }


}
