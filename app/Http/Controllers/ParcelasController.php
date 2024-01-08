<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cheques;
use App\transferencias;
use App\cheques_reb;
use App\cuotas;
use App\estado_cuota;
use App\estado_cheque;
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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParcelasExcel;
use App\Exports\ParcelasExcelCLA;

class ParcelasController extends Controller
{
    
    public function get_proyecto_parcela(Request $request){
        switch ($request->identificador) {
            case 'parcela':
            $proy = proyectos::find($request->ID_proyecto);
            $proy->proy_parcela->each(function($pro_pa){
                    $pro_pa->PC_fecha_uf = Carbon::parse($pro_pa->PC_fecha_uf)->format('Y-m-d');
                    $pro_pa->PC_fecha_creacion = Carbon::parse($pro_pa->PC_fecha_creacion)->format('d-m-Y');
                    $pro_pa->PC_fecha_actualizacion = Carbon::parse($pro_pa->PC_fecha_actualizacion)->format('d-m-Y');
                    $pro_pa->estado;
                    $pro_pa->cliente;
                    $pro_pa->com_pago;
                    $pro_pa->userlog = Auth::user()->ID_tipo_usuario;
                    $pro_pa->cantidad_cheques = $pro_pa->parcela_cheque->count();
                    $pro_pa->cantidad_transferencias = $pro_pa->parcela_transferencias->count();
                    $pro_pa->forma_pago = $pro_pa->PC_forma_pago;
                    $pro_pa->cantidad_cuotas = $pro_pa->parcela_cuotas->count();



                });
        return [
                    'error' => '',
                    'datos' => $proy,
                    'IDP' => $proy->ID_proyecto,
                    'nomP' => $proy->PR_nombre,
                    'ulogin' => Auth::user()->ID_tipo_usuario,
                    'mastplan' => $proy->PR_ruta_master,
                   
                ];
            break;

            default:
                return [
                    'error' => 'Identificador fuera de rango.'
                ];
            break;

        }
    }


    public function nueva_parcela(Request $request){
        $reglas = [
            'PAR_PC_nombre' => 'required',
            'PAR_PC_admin_ant' => 'required',
            'PAR_ID_cliente' => 'required',
            'PAR_PC_valor_parcela' => 'required',
        ];
        $attributes = [
            'PAR_PC_nombre' => 'nombre',
            'PAR_PC_admin_ant' => 'admin',
            'PAR_ID_cliente' => 'cliente',
            'PAR_PC_valor_parcela' => 'valor parcela',
        ];

        $this->validate($request,$reglas,[],$attributes);

        $proy = proyectos::find($request->PAR_ID_proyecto);

        $parcela = parcelas::create([
              'ID_proyecto_macro' => $proy->ID_proyecto_macro,
              'ID_proyecto' => $proy->ID_proyecto,
              'PC_num_parcela' => $request->PAR_PC_num_parcela,
              'PC_nombre' => $request->PAR_PC_nombre,
              'PC_admin_ant' => $request->PAR_PC_admin_ant,
              'ID_cliente' => $request->PAR_ID_cliente,
              'PC_tipo_cambio' => $request->PAR_PC_tipo_cambio,
              'PC_valor_parcela_uf' => $request->PAR_PC_valor_parcela_uf,
              'PC_valor_uf_dia' => $request->PAR_PC_valor_uf_dia,
              'PC_fecha_uf' => $request->PAR_PC_fecha_uf,
              'PC_valor_parcela' => $request->PAR_PC_valor_parcela,
              'PC_forma_pago' => $request->PAR_PC_forma_pago,
              'PC_promesa' => $request->PAR_PC_promesa,
              'PC_reserva' => $request->PAR_PC_reserva,
              'PC_pie' => $request->PAR_PC_pie,
              'PC_monto' => $request->PAR_PC_monto,
              'PC_inicio_credito' =>(($request->PAR_PC_forma_pago == 1) ? $request->PAR_PC_inicio_credito : NULL),
              'PC_dia_pago' => (($request->PAR_PC_forma_pago == 1) ? Carbon::parse($request->PAR_PC_inicio_credito)->format('d') : NULL),
              'PC_fecha_ultima_cuota' =>(($request->PAR_PC_forma_pago == 1) ? Carbon::parse($request->PAR_PC_inicio_credito)->addMonth($request->PAR_PC_cant_cheques) : NULL),
              'PC_cupo_otorgado' => (($request->PAR_PC_forma_pago == 1) ? $request->PAR_PC_cupo_otorgado  : NULL),
              'PC_cant_cheques' => (($request->PAR_PC_forma_pago == 1) ? $request->PAR_PC_cant_cheques  : NULL),
              'PC_tasa_anual' => (($request->PAR_PC_forma_pago == 1) ? $request->PAR_PC_tasa_anual  : NULL),
              'PC_tasa_mensual' =>(($request->PAR_PC_forma_pago == 1) ? ($request->PAR_PC_tasa_anual)/12 : NULL),
              'PC_valor_cuota' => (($request->PAR_PC_forma_pago == 1) ?  (((($request->PAR_PC_tasa_anual)/12)/100)*($request->PAR_PC_cupo_otorgado))/(1-(pow((1+((($request->PAR_PC_tasa_anual)/12)/100)),-$request->PAR_PC_cant_cheques))): NULL),

              'ID_estado' => 3,
              'ID_comp_pago' => 1,

              'PC_cupo_otransf' =>(($request->PAR_PC_forma_pago == 3) ? $request->PAR_PC_cupo_otransf : NULL),
              'PC_cant_transf' =>(($request->PAR_PC_forma_pago == 3) ? $request->PAR_PC_cant_transf : NULL),
              'PC_tasa_anual_transf' =>(($request->PAR_PC_forma_pago == 3) ? $request->PAR_PC_tasa_anual_transf : NULL),
              'PC_tasa_mensual_transf' =>(($request->PAR_PC_forma_pago == 3) ? $request->PAR_PC_tasa_anual_transf/12 : NULL),
              'PC_fecha_inicio_transf' =>(($request->PAR_PC_forma_pago == 3) ? $request->PAR_PC_fecha_inicio_transf : NULL),
              'PC_valor_transf' =>(($request->PAR_PC_forma_pago == 3) ? (((($request->PAR_PC_tasa_anual_transf)/12)/100)*($request->PAR_PC_cupo_otransf))/(1-(pow((1+((($request->PAR_PC_tasa_anual_transf)/12)/100)),-$request->PAR_PC_cant_transf))) : NULL),
              'PC_fecha_ultima_transf' =>(($request->PAR_PC_forma_pago == 3) ? Carbon::parse($request->PAR_PC_fecha_inicio_transf)->addMonth($request->PAR_PC_cant_transf) : NULL),
              'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);

        if($request->PAR_PC_forma_pago == 1){
            for ($i = 1; $i <= $request->PAR_PC_cant_cheques; $i++) {
                $cuotas = cuotas::create([
                    'ID_parcela' =>$parcela->ID_parcela,
                    'CT_nro_cuota' =>$i,
                    'ID_cliente' => $request->PAR_ID_cliente,
                    'CT_fecha_vencimiento' => Carbon::parse($request->PAR_PC_inicio_credito)->addMonth($i-1), 
                    'CT_valor_cuota' => (((($request->PAR_PC_tasa_anual)/12)/100)*($request->PAR_PC_cupo_otorgado))/(1-(pow((1+((($request->PAR_PC_tasa_anual)/12)/100)),-$request->PAR_PC_cant_cheques))),
                    'ID_estado_cuota' => 1,
                    'ID_estado' => 1,
                    'ID_usuario_login'=> Auth::user()->ID_usuario,
                ]);
            }
       }else{

        }

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha agregado la parcela '.$parcela->PAR_PC_nombre,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

   
        return [
            'modelo' => $parcela,
            'cliente' => $parcela->cliente->CL_nombre,
            'nomcomp' => $parcela->com_pago->CP_nombre,
            'colorcomp' => $parcela->com_pago->CP_color,
            'cliente' => $parcela->cliente->CL_nombre,
            'chq' => (($parcela->parcela_cheque->count() == 0) ? '0' : $parcela->parcela_cheque->count()),
            'transfeC' => (($parcela->parcela_transferencias->count() == 0) ? '0' : $parcela->parcela_transferencias->count()),
            'cuotasCL' => $parcela->PC_cant_cheques,
            'transfeCL' => $parcela->PC_cant_transf,
            'forma_pago' => $parcela->PC_forma_pago,
            'estado' => $parcela->estado->E_nombre,
            'fechact' => Carbon::parse($parcela->PC_fecha_actualizacion)->format('d-m-Y'),
            'fechacre' => Carbon::parse($parcela->PC_fecha_creacion)->format('d-m-Y'),
            'request' => $request->all(),
        ];

    }

    public function get_parcela(Request $request){
        $parcela = parcelas::find($request->ID_parcela);
         $parcela->PC_inicio_credito = Carbon::parse($parcela->PC_inicio_credito)->format('Y-m-d');
         $parcela->PC_fecha_inicio_transf = Carbon::parse($parcela->PC_fecha_inicio_transf)->format('Y-m-d');
         if($parcela->PC_tipo_cambio == 1 ){
            $parcela->PC_fecha_uf = NULL;
        }else{
            $parcela->PC_fecha_uf = Carbon::parse($parcela->PC_fecha_uf)->format('Y-m-d');
        }
        return $parcela;
    }

     public function set_parcela(Request $request){
        $reglas = [
            'EditaPAR_PC_nombre' => 'required',
            'EditaPAR_PC_admin_ant' => 'required',
            'EditaPAR_ID_cliente' => 'required',
            
        ];
        $attributes = [
            'EditaPAR_PC_nombre' => 'nombre',
            'EditaPAR_PC_admin_ant' => 'nombre',
            'EditaPAR_ID_cliente' => 'cliente',
        ];
        $this->validate($request,$reglas,[],$attributes);
        
        $parcela = parcelas::find($request->EditaPAR_ID_parcela);
        $parcela->PC_num_parcela = $request->EditaPAR_PC_num_parcela;
        $parcela->PC_nombre = $request->EditaPAR_PC_nombre;
        $parcela->PC_admin_ant = $request->EditaPAR_PC_admin_ant;
        $parcela->ID_cliente = $request->EditaPAR_ID_cliente;
        $parcela->PC_tipo_cambio = $request->EditaPAR_PC_tipo_cambio;
        $parcela->PC_valor_parcela_uf = $request->EditaPAR_PC_valor_parcela_uf;
        $parcela->PC_valor_uf_dia = $request->EditaPAR_PC_valor_uf_dia;
        $parcela->PC_fecha_uf = $request->EditaPAR_PC_fecha_uf;
        $parcela->PC_valor_parcela = $request->EditaPAR_PC_valor_parcela;
        $parcela->PC_promesa = $request->EditaPAR_PC_promesa;
        $parcela->PC_reserva = $request->EditaPAR_PC_reserva;
        $parcela->PC_pie = $request->EditaPAR_PC_pie;
        $parcela->PC_forma_pago = $request->EditaPAR_PC_forma_pago;
        $parcela->PC_monto = $request->EditaPAR_PC_monto;
        
        if ($request->EditaPAR_PC_forma_pago == 1){
            $parcela->PC_inicio_credito = $request->EditaPAR_PC_inicio_credito;
            $parcela->PC_dia_pago = Carbon::parse($request->EditaPAR_PC_inicio_credito)->format('d');
            $parcela->PC_fecha_ultima_cuota = Carbon::parse($request->EditaPAR_PC_inicio_credito)->addMonth($request->EditaPAR_PC_cant_cheques);
            $parcela->PC_cupo_otorgado = $request->EditaPAR_PC_cupo_otorgado;
            $parcela->PC_cant_cheques = $request->EditaPAR_PC_cant_cheques;
            $parcela->PC_tasa_anual = $request->EditaPAR_PC_tasa_anual;
            $parcela->PC_tasa_mensual = ($request->EditaPAR_PC_tasa_anual)/12;
            $tmensual_e =((($request->EditaPAR_PC_tasa_anual)/12)/100);
            $interes_e = ($tmensual_e*$request->EditaPAR_PC_cupo_otorgado);
            $exp_e = pow((1+$tmensual_e),-$request->EditaPAR_PC_cant_cheques);
            $coutas_e = (1-$exp_e);
            $valor_e = ($interes_e/$coutas_e);
            $parcela->PC_valor_cuota =  round($valor_e);

            foreach($parcela->parcela_cuotas as $cu){
                    $cu->CT_valor_cuota = (((($request->EditaPAR_PC_tasa_anual)/12)/100)*($request->EditaPAR_PC_cupo_otorgado))/(1-(pow((1+((($request->EditaPAR_PC_tasa_anual)/12)/100)),-$request->EditaPAR_PC_cant_cheques))); 
                    $cu->save();
            }

            if($request->EditaPAR_PC_cant_cheques  > $parcela->parcela_cuotas->count()){
                $fecha_max  = $parcela->parcela_cuotas->max('CT_fecha_vencimiento');
                $meses = ($request->EditaPAR_PC_cant_cheques - $parcela->parcela_cuotas->count()+1);
                for ($ie = $parcela->parcela_cuotas->max('CT_nro_cuota')+1; $ie < $request->EditaPAR_PC_cant_cheques+1; $ie++) {
                    $cuotas = cuotas::create([
                        'ID_parcela' =>$parcela->ID_parcela,
                        'CT_nro_cuota' =>$ie,
                        'ID_cliente' => $request->EditaPAR_ID_cliente,
                        'CT_fecha_vencimiento' => Carbon::parse($fecha_max)->addMonths($meses++)->subYear(), 
                        'CT_valor_cuota' => (((($request->EditaPAR_PC_tasa_anual)/12)/100)*($request->EditaPAR_PC_cupo_otorgado))/(1-(pow((1+((($request->EditaPAR_PC_tasa_anual)/12)/100)),-$request->EditaPAR_PC_cant_cheques))),
                        'ID_estado_cuota' => 1,
                        'ID_estado' => 1,
                        'ID_usuario_login'=> Auth::user()->ID_usuario,
                    ]);
                }
             
           }else{

           }
     
        }else if($request->EditaPAR_PC_forma_pago == 3){
            $parcela->PC_cupo_otransf = $request->EditaPAR_PC_cupo_otransf;
            $parcela->PC_cant_transf = $request->EditaPAR_PC_cant_transf;
            $parcela->PC_tasa_anual_transf = $request->EditaPAR_PC_tasa_anual_transf;
            $parcela->PC_tasa_mensual_transf = ($request->EditaPAR_PC_tasa_anual_transf/12);
            $parcela->PC_fecha_inicio_transf = $request->EditaPAR_PC_fecha_inicio_transf;
            
            $parcela->PC_valor_transf = (((($request->EditaPAR_PC_tasa_anual_transf)/12)/100)*($request->EditaPAR_PC_cupo_otransf))/(1-(pow((1+((($request->EditaPAR_PC_tasa_anual_transf)/12)/100)),-$request->EditaPAR_PC_cant_transf)));

            $parcela->PC_fecha_ultima_transf = Carbon::parse($request->EditaPAR_PC_fecha_inicio_transf)->addMonth($request->EditaPAR_PC_cant_transf);
            

        } else{
            $parcela->PC_inicio_credito = NULL;
            $parcela->PC_dia_pago =  NULL;
            $parcela->PC_fecha_ultima_cuota =  NULL;
            $parcela->PC_cupo_otorgado =  NULL;
            $parcela->PC_cant_cheques =  NULL;
            $parcela->PC_tasa_anual =  NULL;
            $parcela->PC_tasa_mensual =  NULL;
            $parcela->PC_valor_cuota =  NULL;

             $parcela->PC_cupo_otransf = NULL;
             $parcela->PC_cant_transf = NULL;
             $parcela->PC_fecha_inicio_transf = NULL;
             $parcela->PC_valor_transf = NULL;
             $parcela->PC_fecha_ultima_transf = NULL;
             $parcela->PC_tasa_anual_transf = NULL;
             $parcela->PC_tasa_mensual_transf = NULL;

        }

        if ($request->hasFile('EditaPAR_factura') != '') {
            if ($request->hasFile('EditaPAR_factura')) {
                $fact = $request->file('EditaPAR_factura');
                $adj_factura = date('dmY') . '_' . time() .'_'. $fact->getClientOriginalName();
                $fact->move(storage_path('app/public/parcelas_adj/'), $adj_factura);
            }
            $parcela->PC_factura = $adj_factura;
        }

         if ($request->hasFile('EditaPAR_alzamiento') != '') {
            if ($request->hasFile('EditaPAR_alzamiento')) {
                $alza = $request->file('EditaPAR_alzamiento');
                $adj_alza = date('dmY') . '_' . time() .'_'. $alza->getClientOriginalName();
                $alza->move(storage_path('app/public/parcelas_adj/'), $adj_alza);
            }

            $parcela->PC_alzamiento = $adj_alza;

        }


        $parcela->ID_comp_pago = $request->EditaPAR_ID_comp_pago;
        $parcela->PC_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $parcela->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha modificado la parcela '.$parcela->PC_nombre,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
       
        return [
            'modelo' => $parcela,
            'nomcomp' => $parcela->com_pago->CP_nombre,
            'colorcomp' => $parcela->com_pago->CP_color,
            'cliente' => $parcela->cliente->CL_nombre,
            'chq' => (($parcela->parcela_cheque->count() == 0) ? '0' : $parcela->parcela_cheque->count()),
            'cuotasCL' => $parcela->PC_cant_cheques,
            'forma_pago' => $parcela->PC_forma_pago,
            'estado' => $parcela->estado->E_nombre,
            'fechact' => Carbon::parse($parcela->PC_fecha_actualizacion)->format('d-m-Y'),
            'fechacre' => Carbon::parse($parcela->PC_fecha_creacion)->format('d-m-Y'),
            'request' => $request->all(),
        ];
    }

    public function anular_parcela(Request $request){
        $parcela = parcelas::find($request->ID_parcela);
        $parcela->ID_estado = 2;// DESACTIVADO
        $parcela->save();

         foreach($parcela->parcela_cuotas as $cuo){
            $cuo->ID_estado_cuota = 2; 
            $cuo->save();
         }

         foreach($parcela->parcela_cheque as $pch){
            $pch->ID_estado = 2; 
            $pch->save();
         }

         foreach($parcela->parcela_transferencias as $ptr){
            $ptr->ID_estado = 2; 
            $ptr->save();
         }

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha desactivado la parcela '.$parcela->PC_nombre,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return [
            'titulo' => 'Parcela Deshabilitado',
            'msj' => 'La parcela fue deshabilitada.',
            'color' => 'success',
            'modelo' => $parcela,
            'request' => $request->all(),
        ];
    }


 public function terminar_parcela(Request $request){
        $parcela = parcelas::find($request->ID_parcela);
        $parcela->ID_estado = 4;// DESACTIVADO
        $parcela->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha terminado la parcela '.$parcela->PC_nombre,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return [
            'titulo' => 'Parcela Terminada',
            'msj' => 'La parcela fue terminada.',
            'color' => 'success',
            'modelo' => $parcela,
            'request' => $request->all(),
        ];
    }




    public function get_resumen_parcela(Request $request){
        $parcela = parcelas::find($request->ID_parcela);
        $parcela->nomPC = $parcela->PC_nombre;
        $parcela->tr_cliente = $parcela->cliente->CL_nombre;
        $parcela->tr_valor_parcela = '$ '.number_format($parcela->PC_valor_parcela,0,",","."); 
        $parcela->tr_reserva_parcela='$ '.number_format( round($parcela->PC_reserva),0,",",".");
        $parcela->tr_compraventa='$ '.number_format( round($parcela->PC_promesa),0,",",".");
        if ($parcela->PC_forma_pago == 1) {
           $parcela->tr_forma_pago = 'Cr&eacute;dito Directo';
        }else if ($parcela->PC_forma_pago == 2) {
            $parcela->tr_forma_pago = 'Contado';
        }else{
            $parcela->tr_forma_pago = 'Transferencia Mensual';
        }
        
        if ($parcela->PC_forma_pago == 1) {
                $parcela->tr_pie_parcela='$ '.number_format( round($parcela->PC_pie),0,",",".");
                $parcela->tr_inicio_credito = Carbon::parse($parcela->PC_inicio_credito)->format('d-m-Y');
                $parcela->tr_cupo = '$ '.number_format($parcela->PC_cupo_otorgado,0,",",".");
                $parcela->tr_tasa_interes = $parcela->PC_tasa_anual.' %';
                $parcela->tr_cant_cheques = $parcela->PC_cant_cheques;
                $parcela->tr_ultima_cuota = Carbon::parse($parcela->PC_fecha_ultima_cuota)->format('d-m-Y');
                    $tmensual =($parcela->PC_tasa_mensual/100);
                    $interes = ($tmensual*$parcela->PC_cupo_otorgado);
                    $exp = pow((1+$tmensual),-$parcela->PC_cant_cheques);
                    $coutas = (1-$exp);
                    $valor = ($interes/$coutas);
                $parcela->tr_valor_cuota ='$ '.number_format( round($valor),0,",","."); 
                $parcela->tr_cuotas_pagadas = $parcela->parcela_cheque_pag->count();
                $parcela->tr_cuotas_atrasadas = $parcela->parcela_cheque_atr->count();
                    $pagadas = $parcela->parcela_cheque_pag->count();
                    $enmora = $parcela->parcela_cheque_atr->count();
                $parcela->tr_monto_pagado ='$ '.number_format(round($valor)*$pagadas,0,",",".");
                $parcela->tr_monto_atrasado ='$ '.number_format(round($valor)*$enmora,0,",",".");
                    $saldo = (($parcela->PC_cant_cheques*round($valor)) - round($valor)*$pagadas);
                $parcela->tr_saldo ='$ '.number_format($saldo,0,",",".");
        
        }else if($parcela->PC_forma_pago == 3){
                $parcela->tr_fecha_iniT= Carbon::parse($parcela->PC_fecha_inicio_transf)->format('d-m-Y');
                $parcela->tr_cupoT = '$ '.number_format( round($parcela->PC_cupo_otransf),0,",",".");
                $parcela->tr_tasa_interesT = $parcela->PC_tasa_anual_transf.' %';
                $parcela->tr_ntransfer = $parcela->PC_cant_transf;
                $parcela->tr_cuotaT = '$ '.number_format(round($parcela->PC_valor_transf),0,",",".");
                $parcela->tr_UcuotaT = Carbon::parse($parcela->PC_fecha_ultima_transf)->format('d-m-Y');
                $parcela->tr_cuotas_pagadasT = $parcela->parcela_transfer_pag->count();
                $parcela->tr_cuotas_atrasadasT = $parcela->parcela_transfer_atr->count();
                    $pagadasT = $parcela->parcela_transfer_pag->count();
                    $enmoraT = $parcela->parcela_transfer_atr->count();

                $parcela->tr_monto_pagadoT ='$ '.number_format(round($parcela->parcela_transfer_pag->sum('TR_monto')),0,",",".");
                $parcela->tr_monto_atrasadoT ='$ '.number_format(round($parcela->parcela_transfer_atr->sum('TR_monto')),0,",",".");
                    $saldoT = (($parcela->PC_cant_transf*round($parcela->PC_valor_transf)) - round($parcela->parcela_transfer_pag->sum('TR_monto')));

                $parcela->tr_saldoT ='$ '.number_format($saldoT,0,",",".");
        }else{
                $parcela->tr_monto_contado = '$ '.number_format($parcela->PC_monto,0,",",".");
        }
        
        return $parcela;
    }


public function get_print_resumen_parcela(Request $request){
        $datos = [
            'resParcelas' => parcelas::find($request->id)
        ];

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha descargado el Resumen de la Parcela con ID '.$request->id,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $pdf = PDF::loadView('proyectos.formatos.formato_impresion_resumen_parcelas', $datos);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->download('resumen_de _parcela-'.$request->id.'.pdf');
}


public function export_parcelas_ple(){

        return Excel::download(new ParcelasExcel, 'informe_parcelas_ple.xlsx');
    }

public function export_parcelas_cla(){

        return Excel::download(new ParcelasExcelCLA, 'informe_parcelas_cla.xlsx');
}


    

/*---------------------------------- CUOTAS---------------------------------- */


public function get_parcela_cuotas(Request $request){
        switch ($request->identificador) {
            case 'c_cuotas':
            $par_c = parcelas::find($request->ID_parcela);
            $par_c->parcela_cuotas->each(function($pa_cuota){
                    $pa_cuota->CT_fecha_creacion = Carbon::parse($pa_cuota->CT_fecha_creacion)->format('d-m-Y');
                    $pa_cuota->CT_fecha_actualizacion = Carbon::parse($pa_cuota->CT_fecha_actualizacion)->format('d-m-Y');
                    $pa_cuota->CT_fecha_vencimiento = Carbon::parse($pa_cuota->CT_fecha_vencimiento)->format('d-m-Y');
                    $pa_cuota->CT_fecha_pago = (($pa_cuota->CT_fecha_pago == NULL) ? ' - '  :Carbon::parse($pa_cuota->CT_fecha_pago)->format('d-m-Y'));
                    $pa_cuota->estado;
                    $pa_cuota->estado_cuota;
                    $pa_cuota->cliente;
                    $pa_cuota->userlog = Auth::user()->ID_tipo_usuario;
                    $pa_cuota->CT_valor_cuota = '$ '.number_format($pa_cuota->CT_valor_cuota,0,",",".");

                });
        return [
                    'error' => '',
                    'datos' => $par_c,
                    'IDpar' => $par_c->ID_parcela,
                    'nomPar' => $par_c->PC_nombre,
                    'valorcuotap' =>'$ '.number_format($par_c->PC_valor_cuota,0,",","."),
                    'numcuota' => $par_c->PC_cant_cheques,
                    'ulogin' => Auth::user()->ID_tipo_usuario,
                   
                ];
            break;

            default:
                return [
                    'error' => 'Identificador fuera de rango.'
                ];
            break;

        }
    }


public function get_cuota(Request $request){
        $cuota = cuotas::find($request->ID_cuota);
         $cuota->CT_fecha_vencimiento = Carbon::parse($cuota->CT_fecha_vencimiento)->format('Y-m-d');
        $cuota->parcela;
        return $cuota;
    }


public function set_cuota(Request $request){
        $reglas = [
            'EditaCU_CT_fecha_vencimiento' => 'required',
            'EditaCU_CT_valor_cuota' => 'required',
        ];
        $attributes = [
            'EditaCU_CT_fecha_vencimiento' => 'nombre',
            'EditaCU_CT_valor_cuota' => 'nombre',
        ];
        $this->validate($request,$reglas,[],$attributes);
        
        $cuota = cuotas::find($request->EditaCU_ID_cuota);
        $cuota->CT_fecha_vencimiento = $request->EditaCU_CT_fecha_vencimiento;
        $cuota->CT_valor_cuota = $request->EditaCU_CT_valor_cuota;
        $cuota->ID_estado_cuota = $request->EditaCU_ID_estado_cuota;
        $cuota->CT_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $cuota->save();

         if($request->EditaCU_ID_estado_cuota == 1){
            $cuota = cuotas::find($request->EditaCU_ID_cuota);
            $cuota->CT_fecha_pago = NULL;
            $cuota->CT_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
            $cuota->save();

         }

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha modificado la cuota '.$cuota->CT_nro_cuota.' de la parcela con ID '.$cuota->ID_parcela,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
       
        return [
            'modelo' => $cuota,
            'nrocuota' => $cuota->CT_nro_cuota,
            'fechvec' => Carbon::parse($cuota->CT_fecha_vencimiento)->format('d-m-Y'),
            'valorcuota' =>'$ '.number_format($cuota->CT_valor_cuota,0,",","."),
            'estadocuota' => $cuota->estado_cuota->ECT_nombre,
            'fechapago' =>(($cuota->CT_fecha_pago == NULL) ? ' - '  : Carbon::parse($cuota->CT_fecha_pago)->format('d-m-Y')),
            'request' => $request->all(),
        ];
    }


public function anular_cuota(Request $request){
        $cuota = cuotas::find($request->ID_cuota);
        $cuota->ID_estado = 2;// DESACTIVADO
        $cuota->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha anulado la cuota '.$cuota->CT_nro_cuota.' de la parcela con ID '.$cuota->ID_parcela,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return [
            'titulo' => 'Cuota Deshabilitada',
            'msj' => 'La  fue deshabilitada.',
            'color' => 'success',
            'modelo' => $cuota,
            'request' => $request->all(),
        ];
    }




    public function get_print_cuadro_pagos(Request $request){
        $datos = [
            'cuadroP' => parcelas::find($request->cp)
        ];

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha descargado el Cuadro de Pagos de la Parcela con ID '.$request->cp,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $pdf = PDF::loadView('proyectos.formatos.formato_impresion_cuadro_pagos', $datos);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->download('CuadroDePagos-'.$request->cp.'.pdf');
}


}

