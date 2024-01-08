<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cheques;
use App\transferencias;
use App\cheques_reb;
use App\cuotas;
use App\estado_cuota;
use App\estado_cheque;
use App\estado_transfer;
use App\comp_pago;
use App\proyectos;
use App\proyectos_macro;
use App\parcelas;
use App\clientes;
use App\usuarios;
use App\historial;
use Auth;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class ProyectosController extends Controller
{
    public function ver_proyectos(Request $request){
        
        $proyectos = proyectos::where('ID_Estado',1)->where('ID_proyecto_macro', 1)->get();
        $clientes = clientes::where('ID_estado',1)->pluck('CL_nombre','ID_cliente');
        $proymacro = proyectos_macro::where('ID_proyecto_macro',1)->pluck('PRM_nombre','ID_proyecto_macro');
        $estadoche = estado_cheque::where('ID_estado',1)->pluck('ECH_nombre','ID_estado_cheque');
        $estadocuota= estado_cuota::where('ID_estado',1)->pluck('ECT_nombre','ID_estado_cuota');
        $estadotransfer = estado_transfer::where('ID_estado',1)->pluck('ETF_nombre','ID_estado_transfer');
         $cuotaspar = cuotas::select(
            DB::raw("CONCAT(CT_nro_cuota,' - ',clientes.CL_nombre) AS c_cliente"), 'ID_cuota')->join('clientes', 'clientes.ID_cliente', '=', 'cuotas.ID_cliente')
             ->where('cuotas.ID_estado',1)
             ->whereIn('cuotas.ID_estado_cuota',[1,2])
            ->pluck('c_cliente','ID_cuota');
        $comportamiento = comp_pago::where('ID_estado',1)->pluck('CP_nombre','ID_comp_pago');


        
        return view('proyectos.proyectos.index')
        ->with('proyectos',$proyectos)
        ->with('clientes',$clientes)
        ->with('proymacro',$proymacro)
        ->with('estadoche',$estadoche)
        ->with('estadocuota',$estadocuota)
        ->with('cuotaspar',$cuotaspar)
        ->with('comportamiento',$comportamiento)
        ->with('estadotransfer',$estadotransfer)
      
        ;

    }

    public function ver_proyectos_cla(Request $request){
        
        $proyectos = proyectos::where('ID_Estado',1)->where('ID_proyecto_macro', 2)->get();
        $clientes = clientes::where('ID_estado',1)->pluck('CL_nombre','ID_cliente');
        $proymacro = proyectos_macro::where('ID_proyecto_macro',2)->pluck('PRM_nombre','ID_proyecto_macro');
        $estadoche = estado_cheque::where('ID_estado',1)->pluck('ECH_nombre','ID_estado_cheque');
        $estadocuota= estado_cuota::where('ID_estado',1)->pluck('ECT_nombre','ID_estado_cuota');
        $estadotransfer = estado_transfer::where('ID_estado',1)->pluck('ETF_nombre','ID_estado_transfer');
         $cuotaspar = cuotas::select(
            DB::raw("CONCAT(CT_nro_cuota,' - ',clientes.CL_nombre) AS c_cliente"), 'ID_cuota')->join('clientes', 'clientes.ID_cliente', '=', 'cuotas.ID_cliente')
             ->where('cuotas.ID_estado',1)
             ->whereIn('cuotas.ID_estado_cuota',[1,2])
            ->pluck('c_cliente','ID_cuota');
        $comportamiento = comp_pago::where('ID_estado',1)->pluck('CP_nombre','ID_comp_pago');


        
        return view('proyectos.crucelosavellanos.index')
        ->with('proyectos',$proyectos)
        ->with('clientes',$clientes)
         ->with('proymacro',$proymacro)
        ->with('estadoche',$estadoche)
        ->with('estadocuota',$estadocuota)
        ->with('cuotaspar',$cuotaspar)
        ->with('comportamiento',$comportamiento)
        ->with('estadotransfer',$estadotransfer)
      
        ;

    }


     public function nuevo_proyecto(Request $request){
        $reglas = [
            'PR_nombre' => 'required',
        ];
        $attributes = [
            'PR_nombre' => 'nombre',
        ];

        $this->validate($request,$reglas,[],$attributes);

        if ($request->hasFile('PR_ruta_master') != '') {
            if ($request->hasFile('PR_ruta_master')) {
                $proyectos = $request->file('PR_ruta_master');
                $adj_master = date('dmY') . '_' . time() .'_'. $proyectos->getClientOriginalName();

                $proyectos->move(base_path('public/img/masterp/'), $adj_master);
            }
        }else{

            $adj_master = NULL;
        }
 
        $proyectos = proyectos::create([
              'ID_proyecto_macro' => $request->ID_proyecto_macro,
              'PR_nombre' => $request->PR_nombre,
              'PR_descripcion' => $request->PR_descripcion,
              'PR_fecha_inicio_ventas' => $request->PR_fecha_inicio_ventas,
              'PR_total_unidades' => $request->PR_total_unidades,
              'PR_ruta_master' => $adj_master,
              'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha agregado el proyecto'.$proyectos->PR_nombre,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


   
        return [
            'titulo' => 'Proyecto agregado con exito!',
            'msj' => 'Se ha agregado un nuevo proyecto',
            'color' => 'success',
            'modelo' => $proyectos,
            'request' => $request->all(),
        ];

    }

    public function get_proyecto(Request $request){
        $proyectos = proyectos::find($request->ID_proyecto);
        $proyectos->PR_fecha_inicio_ventas = Carbon::parse($proyectos->PR_fecha_inicio_ventas)->format('Y-m-d');
        return $proyectos;
    }


    public function set_proyecto(Request $request){
         $reglas = [
            'EditaP_PR_nombre' => 'required',
        ];
        $attributes = [
            'EditaP_PR_nombre' => 'prioridad',  
        ];
        $this->validate($request,$reglas,[],$attributes);
        
        $proyectos = proyectos::find($request->EditaP_ID_proyecto);
        $proyectos->PR_nombre = $request->EditaP_PR_nombre;
        $proyectos->PR_descripcion = $request->EditaP_PR_descripcion;
        $proyectos->PR_fecha_inicio_ventas = $request->EditaP_PR_fecha_inicio_ventas;
        $proyectos->PR_total_unidades = $request->EditaP_PR_total_unidades;

         if ($request->hasFile('EditaP_ruta_master') != '') {
            if ($request->hasFile('EditaP_ruta_master')) {
                $proy = $request->file('EditaP_ruta_master');
                $adj_masterE= date('dmY') . '_' . time() .'_'. $proy->getClientOriginalName();

                $proy->move(base_path('public/img/masterp/'), $adj_masterE);
            }

            $proyectos->PR_ruta_master = $adj_masterE;

        }


        $proyectos->PR_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $proyectos->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha modificado el proyecto '.$proyectos->PR_nombre,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
       
        return [
            'titulo' => 'Proyecto Modicado!',
            'msj' => 'Se ha modificado el proyecto',
            'color' => 'success',
            'modelo' => $proyectos,
            'request' => $request->all(),
        ];
    }


    public function anular_proyecto(Request $request){
        $proyectos = proyectos::find($request->ID_proyecto);
        $proyectos->ID_estado = 2;// DESACTIVADO
        $proyectos->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. 'ha desactivado el proyecto'.$proyectos->PR_nombre,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return [
            'titulo' => 'Proyecto Deshabilitado',
            'msj' => 'El proyecto fue deshabilitado.',
            'color' => 'success',
            'modelo' => $proyectos,
            'request' => $request->all(),
        ];
    }

    public function get_flujo_proyecto(Request $request){
        $proy = proyectos::find($request->ID_proyecto);
        $proy->nomPro = $proy->PR_nombre;
        $proy->tr_fechaIV = Carbon::parse($proy->PR_fecha_inicio_ventas)->format('d-m-Y');
        $proy->tr_uniproy = $proy->PR_total_unidades;
        $proy->tr_univencont = $proy->proy_parcela_cont->count();
            $porcen_cont = (($proy->proy_parcela_cont->count())*100)/$proy->PR_total_unidades;
        $proy->tr_poruniventcont = number_format($porcen_cont,1,",","."). '%';
        $proy->tr_univentCD = $proy->proy_parcela_cd->count();
            $porcen_cred = (($proy->proy_parcela_cd->count())*100)/$proy->PR_total_unidades;
        $proy->tr_poruniventCD = number_format($porcen_cred,1,",","."). '%';
            $reserva = $proy->proy_parcela->sum('PC_reserva');
            $pie = $proy->proy_parcela->sum('PC_pie');
            $monto_cont = $proy->proy_parcela->sum('PC_monto');
            $monto_cred = $proy->proy_cheque_cd->sum('CHQ_monto');
            $monto_transfer = $proy->proy_transfer_cd->sum('TR_monto');
            $total_contado_credito = ($reserva+$pie+$monto_cont+$monto_cred+$monto_transfer);
        $proy->tr_montoTRUVF = '$ '.number_format( round($total_contado_credito),0,",",".");
            $reserva_cd = $proy->proy_parcela_cd->sum('PC_reserva');
            $pie_cd = $proy->proy_parcela_cd->sum('PC_pie');
            $total_monto_credito = ($reserva_cd+$pie_cd+$monto_cred);
        $proy->tr_montoTRUVFCD =  '$ '.number_format( round($total_monto_credito),0,",",".");
            $cant_cred = $proy->proy_cheques->count();
        $proy->tr_cantchqrecfecha = $cant_cred;
            $n_cheques = $proy->proy_parcela_cd->count();
        $proy->tr_nchqdm = $n_cheques;
            $valorCuota = $proy->proy_parcela->sum('PC_valor_cuota');
        $proy->tr_fmchqd = '$ '.number_format( round($valorCuota),0,",",".");
        $proy->tr_chqprnopaghis = $proy->proy_cheque_reb->count();
        $proy->tr_montochqprnopaghis = '$ '.number_format($proy->proy_cheque_reb->sum('CR_monto_cheque'),0,",",".");
        $proy->tr_chqprnopagact = $proy->proy_cheque_reb_real->count();
        $proy->tr_montochqprnopagact = '$ '.number_format($proy->proy_cheque_reb_real->sum('CHQ_monto'),0,",",".");
        $proy->tr_fechfinvenproy = (($proy->PR_fecha_fin_ventas == null ) ? ' - ' : Carbon::parse( $proy->PR_fecha_fin_ventas)->format('d-m-Y'));
            $ultima_cuota = $proy->proy_parcela->max('PC_fecha_ultima_cuota');
        $proy->tr_fechulchqcob = Carbon::parse($ultima_cuota)->format('d-m-Y');
        
        return $proy;
    }

    public function get_print_flujo_proyecto(Request $request){
        $datosp = [
            'proyf' => proyectos::find($request->idp)
        ];

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha descargado el Flujo del Proyecto con ID '.$request->idp,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $pdf = PDF::loadView('proyectos.formatos.formato_impresion_flujo_proyecto', $datosp);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->download('Flujo_Proyecto-'.$request->idp.'.pdf');
}



}

