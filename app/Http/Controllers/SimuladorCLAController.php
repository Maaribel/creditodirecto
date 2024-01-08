<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cheques;
use App\cheques_reb;
use App\cuotas;
use App\cuotas_sim;
use App\estado_cuota;
use App\estado_cheque;
use App\comp_pago;
use App\proyectos;
use App\parcelas;
use App\clientes;
use App\usuarios;
use App\simulador;
use App\simulador_cla;
use App\cuotas_scla;
use App\tasa_anual_proy;
use App\historial;
use Auth;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class SimuladorCLAController extends Controller
{
    
    public function ver_simulador_cla(Request $request){
                                    
        $simuladorcla = simulador_cla::where('ID_Estado',1)->get();

         
      
        return view('simulador.simulador_cla.index')
        ->with('simuladorcla',$simuladorcla)

        ;

    }





    public function nueva_simulacion_cla(Request $request){
        $reglas = [
            'SCLA_nom_cliente' => 'required',
            'SCLA_nom_parcela' => 'required',
            'SCLA_valor_parcela' => 'required',
        ];
        $attributes = [
            'SCLA_nom_cliente' => 'cliente',
            'SCLA_nom_parcela' => 'nombre  parcela',
            'SCLA_valor_parcela' => 'valor parcela',
        ];

        $this->validate($request,$reglas,[],$attributes);

        $simulacioncla = simulador_cla::create([
              'SCLA_nom_proyecto' => $request->SCLA_nom_proyecto,
              'SCLA_nom_parcela' => $request->SCLA_nom_parcela,
              'SCLA_nom_cliente' => $request->SCLA_nom_cliente,
              'SCLA_valor_parcela_uf' => $request->SCLA_valor_parcela_uf,
              'SCLA_uf_hoy' => $request->SCLA_uf_hoy,
              'SCLA_fecha_uf_dia' => $request->SCLA_fecha_uf_dia ,
              'SCLA_valor_parcela' => $request->SCLA_valor_parcela,
              'SCLA_reserva' => $request->SCLA_reserva,
              'SCLA_pie' => $request->SCLA_pie,
              'SCLA_compraventa' => $request->SCLA_compraventa,
              'SCLA_fecha_inicio_credito' => $request->SCLA_fecha_inicio_credito,
              'SCLA_dia_pago' => Carbon::parse($request->SCLA_fecha_inicio_credito)->format('d'),
              'SCLA_fecha_ultima_cuota' =>Carbon::parse($request->SCLA_fecha_ultima_cuota)->addMonth($request->SCLA_cantidad_cheques),
              'SCLA_cupo_otorgado' => $request->SCLA_cupo_otorgado,
              'SCLA_interes' => ($request->SCLA_cupo_otorgado*((($request->SCLA_tasa_anual)/12)/100)),
              'SCLA_saldo' => (($request->SCLA_cupo_otorgado*((($request->SCLA_tasa_anual)/12)/100))+$request->SCLA_cupo_otorgado),
              'SCLA_cantidad_cheques' => $request->SCLA_cantidad_cheques,
              'SCLA_tasa_anual' => $request->SCLA_tasa_anual,
              'SCLA_tasa_mensual' =>($request->SCLA_tasa_anual)/12,
              'SCLA_valor_cuota' => (((($request->SCLA_tasa_anual)/12)/100)*($request->SCLA_cupo_otorgado))/(1-(pow((1+((($request->SCLA_tasa_anual)/12)/100)),-$request->SCLA_cantidad_cheques))),
              'ID_estado' => 1,
              'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);
                

            for ($i = 1; $i <= $simulacioncla->SCLA_cantidad_cheques; $i++) {
                $cuotas_scla = cuotas_scla::create([
                    'ID_simulador_cla' =>$simulacioncla->ID_simulador_cla,
                    'CCLA_nro_cuota' =>$i,
                    'CCLA_fecha_vencimiento' => Carbon::parse($request->SCLA_fecha_inicio_credito)->addMonths($i-1), 
                    'CCLA_valor_cuota' => (((($simulacioncla->SCLA_tasa_anual)/12)/100)*($request->SCLA_cupo_otorgado))/(1-(pow((1+((($simulacioncla->SCLA_tasa_anual)/12)/100)),-$request->SCLA_cantidad_cheques))),
                    'CCLA_saldo_ini' => $simulacioncla->SCLA_saldo,
                    'CCLA_capital' => $simulacioncla->SCLA_saldo -$simulacioncla->SCLA_valor_cuota,
                    'CCLA_interes' => $simulacioncla->SCLA_interes,
                    'CCLA_saldo' => $simulacioncla->SCLA_saldo,
                    'ID_estado' => 1,
                    'ID_usuario_login'=> Auth::user()->ID_usuario,
                ]);
            }

            foreach($simulacioncla->simuladorcla_cuotascla as $scuc){
                $scuc->CCLA_capital = ($simulacioncla->simuladorcla_cuotascla->min('CCLA_saldo') - $scuc->CCLA_valor_cuota);
                $scuc->CCLA_interes = ($simulacioncla->simuladorcla_cuotascla->min('CCLA_saldo') - $scuc->CCLA_valor_cuota)*($simulacioncla->SCLA_tasa_mensual/100);
                $scuc->CCLA_saldo =  ($simulacioncla->simuladorcla_cuotascla->min('CCLA_saldo') - $scuc->CCLA_valor_cuota) + ($simulacioncla->simuladorcla_cuotascla->min('CCLA_saldo') - $scuc->CCLA_valor_cuota)*($simulacioncla->SCLA_tasa_mensual/100);
                $scuc->CCLA_saldo_ini = ($simulacioncla->simuladorcla_cuotascla->min('CCLA_saldo'));
                $scuc->save();
            }

            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha creado una simulación en CLA',
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
           
        return [
            'titulo' => 'Simulacion creado con exito!',
            'msj' => 'Se ha agregado una simulacion',
            'color' => 'success',
            'modelo' => $simulacioncla,
            'request' => $request->all(),
        ];

    }


    public function get_print_simulacion_cla(Request $request){
            $datos = [
                'simulacioncla' => simulador_cla::find($request->simcla)
            ];

            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha descargado el formato simple de la simulacion con ID '.$request->sim,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $pdf = PDF::loadView('simulador.formatos.formato_impresion_simulacion_credito_cla', $datos);
            $pdf->setPaper('letter', 'portrait');
            return $pdf->download('SimulacionSimpleCLA-'.$request->simcla.'.pdf');
    }


     public function anular_simulacion_cla(Request $request){
        $simuladorcla = simulador_cla::find($request->ID_simulador_cla);
        $simuladorcla->ID_estado = 2;// DESACTIVADO
        $simuladorcla->save();

        foreach($simuladorcla->simuladorcla_cuotascla as $simcu){
            $simcu->ID_estado = 2;
            $simcu->save();
        }

        return [
            'titulo' => 'La simulacion fue eliminada',
            'msj' => 'La simulacion fue eliminada',
            'color' => 'success',
            'modelo' => $simuladorcla,
            'request' => $request->all(),
        ];
    }


/*--------------------------- CUOTAS SIMULADOR ------------------------------------- 
*/

public function get_simulador_cuotas_cla(Request $request){
        switch ($request->identificador) {
            case 'sim_cuotas_cla':
            $simcuocla = simulador_cla::find($request->ID_simulador_cla);
            $simcuocla->simuladorcla_cuotascla->each(function($sim_cuotacla){
                    $sim_cuotacla->CCLA_fecha_creacion = Carbon::parse($sim_cuotacla->CCLA_fecha_creacion)->format('d-m-Y');
                    $sim_cuotacla->CCLA_fecha_actualizacion = Carbon::parse($sim_cuotacla->CCLA_fecha_actualizacion)->format('d-m-Y');
                    $sim_cuotacla->CCLA_fecha_vencimiento = Carbon::parse($sim_cuotacla->CCLA_fecha_vencimiento)->format('d-m-Y');
                    $sim_cuotacla->estado;
                    $sim_cuotacla->userlog = Auth::user()->ID_tipo_usuario;
                    $sim_cuotacla->CCLA_valor_cuota = '$ '.number_format(bcdiv($sim_cuotacla->CCLA_valor_cuota,1),0,",",".");
                    $sim_cuotacla->CCLA_capital = '$ '.number_format($sim_cuotacla->CCLA_capital,0,",",".");
                    $sim_cuotacla->CCLA_interes = '$ '.number_format($sim_cuotacla->CCLA_interes,0,",",".");
                    $sim_cuotacla->CCLA_saldo = '$ '.number_format($sim_cuotacla->CCLA_saldo,0,",",".");
                    

                });
        return [
                    'error' => '',
                    'datos' => $simcuocla,
                    'IDsimcla' => $simcuocla->ID_simulador_cla,
                    'valorcuotasim_cla' =>'$'.number_format($simcuocla->SCLA_valor_cuota,0,",","."),
                    'numcuotasim_cla' => $simcuocla->SCLA_cantidad_cheques,
                    'prestamo_cla' => '$'.number_format($simcuocla->SCLA_cupo_otorgado,0,",","."),
                    'tasaanual_cla' => $simcuocla->SCLA_tasa_anual. '%',
                    'tasamensual_cla' =>  number_format($simcuocla->SCLA_tasa_mensual,2,",","."). '%',
                    'totalsim_cla' =>'$'.number_format($simcuocla->SCLA_valor_cuota*$simcuocla->SCLA_cantidad_cheques,0,",","."),
                    'costosim_cla' =>'$'.number_format(($simcuocla->SCLA_valor_cuota*$simcuocla->SCLA_cantidad_cheques)-$simcuocla->SCLA_cupo_otorgado,0,",","."),
                    'interessim_cla' =>'$'.number_format($simcuocla->SCLA_interes,0,",","."),
                    'saldosim_cla' =>'$'.number_format($simcuocla->SCLA_saldo,0,",","."),
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


    public function get_print_simulacion_cuotas_cla(Request $request){
            $datos = [
                'simulacionccla' => simulador_cla::find($request->simccla)
            ];

            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha descargado el formato dellatado de la simulacion con ID '.$request->simc,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $pdf = PDF::loadView('simulador.formatos.formato_impresion_simulacion_cuadro_pagoscla', $datos);
            $pdf->setPaper('letter', 'portrait');
            return $pdf->download('SimulacionCuadroDePagosCLA-'.$request->simccla.'.pdf');
    }



/*--------------------------- FIN CUOTAS SIMULADOR -------------------------------- */

   

}

