<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\usuarios;
use App\simulador_ldm;
use App\cuotas_sldm;
use App\ncuotas_uf;
use App\parcelas_lista_ldm;
use App\historial;
use Auth;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class SimuladorLDMController extends Controller
{
    
    public function ver_simuladorldm(Request $request){
                                    
        $simuladorldm = simulador_ldm::where('ID_Estado',1)->get();
        $listaparcelas = parcelas_lista_ldm::where('ID_estado',1)->pluck('PLM_nombre','ID_parcelas_lista_ldm');
        $cuotasldm = ncuotas_uf::where('ID_estado',1)->pluck('NC_cuotas','ID_ncuotas_uf');

        
      
        return view('simulador.simulador_ldm_uf.index')
        ->with('simuladorldm',$simuladorldm)
        ->with('listaparcelas',$listaparcelas)
        ->with('cuotasldm',$cuotasldm)

        ;

    }

    public function get_listap_sim(Request $request){
        $parcelaldm = parcelas_lista_ldm::find($request->ID_parcelas_lista_ldm);
        $parcelaldm->parcelasldm_simldm;
        return $parcelaldm;
    }

     public function nueva_simulacion_ldm(Request $request){
        $reglas = [
            'SLM_datos_cliente' => 'required',
            'SLM_fecha_promesa' => 'required',
            'ID_parcela_lista' => 'required',
        ];
        $attributes = [
            'SLM_datos_cliente'=> 'cliente',
            'SLM_fecha_promesa' => 'fecha promesa',
            'ID_parcela_lista' => 'parcela',
        ];

        $this->validate($request,$reglas,[],$attributes);

        $tasa = ncuotas_uf::find($request->ID_ncuotas_uf);

        $simulacionldm = simulador_ldm::create([
              'SLM_datos_cliente' => $request->SLM_datos_cliente,
              'SLM_fecha_promesa' => $request->SLM_fecha_promesa,
              'SLM_fecha_promesa2' =>  Carbon::parse($request->SLM_fecha_promesa)->addMonth(1),
              'SLM_valorufhoy' => $request->SLM_valorufhoy,
              'ID_parcela_lista' => $request->ID_parcela_lista,
              'SLM_pie_solicitado' => $request->SLM_pie_solicitado,
              'SLM_monto_pie' => $request->SLM_monto_pie,
              'SLM_cupo_otorgado' => $request->SLM_cupo_otorgado,
              'ID_ncuotas_uf' => $request->ID_ncuotas_uf,
              'SLM_interes_anual' =>$tasa->NC_tasa_anual,
              'SLM_interes_mensual' => pow(1+$tasa->NC_tasa_anual/100, (1/12))-1,
              'SLM_tipo_credito' => $request->SLM_tipo_credito,
              'SLM_valor_cuota' => ((pow(1+$tasa->NC_tasa_anual/100, (1/12))-1)*($request->SLM_cupo_otorgado))/(1-(pow(1+(pow(1+$tasa->NC_tasa_anual/100, (1/12))-1), -$tasa->NC_cuotas))),
              'SLM_cuota_final' => $request->SLM_cuota_final,
              'SLM_monto_cuota_final' => $request->SLM_monto_cuota_final,
              'ID_estado' => 1,
              'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);
                
            for ($i = 1; $i <= $tasa->NC_cuotas; $i++) {
                $cuotas_sldm = cuotas_sldm::create([
                    'ID_simulador_ldm' =>$simulacionldm->ID_simulador_ldm,
                    'SCLM_nro_cuota' =>$i,
                    'SCLM_fecha_vencimiento' => Carbon::parse($simulacionldm->SLM_fecha_promesa2)->addMonths($i), 
                    'SCLM_valor_cuota' => $simulacionldm->SLM_valor_cuota,
                    'SCLM_saldo_ini' => $simulacionldm->SLM_cupo_otorgado,
                    'SCLM_capital' => $simulacionldm->SLM_cupo_otorgado - $simulacionldm->SLM_valor_cuota + ($simulacionldm->SLM_interes_mensual*$simulacionldm->SLM_cupo_otorgado),
                    'SCLM_interes' => $simulacionldm->SLM_interes_mensual*$simulacionldm->SLM_cupo_otorgado,
                    'SCLM_abono' =>$simulacionldm->SLM_valor_cuota - ($simulacionldm->SLM_interes_mensual*$simulacionldm->SLM_cupo_otorgado),
                    'ID_estado' => 1,
                    'ID_usuario_login'=> Auth::user()->ID_usuario,
                ]);
            }

          
                    foreach($simulacionldm->simuladorldm_cuotasldm as $scu){
                        if ($scu->SCLM_nro_cuota != 1) {
                            $scu->SCLM_saldo_ini = ($simulacionldm->simuladorldm_cuotasldm->min('SCLM_capital'));
                   
                            $scu->SCLM_interes = $simulacionldm->simuladorldm_cuotasldm->min('SCLM_saldo_ini') *$simulacionldm->SLM_interes_mensual;

                            $scu->SCLM_abono = $scu->SCLM_valor_cuota - $simulacionldm->simuladorldm_cuotasldm->min('SCLM_interes');
                            
                            $scu->SCLM_capital = $simulacionldm->simuladorldm_cuotasldm->min('SCLM_saldo_ini') - $scu->SCLM_valor_cuota + $simulacionldm->simuladorldm_cuotasldm->min('SCLM_saldo_ini')*$simulacionldm->SLM_interes_mensual;

                            $scu->save();
                        }
                    
                }


            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha creado una simulación en simulador LDM',
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
           

        return [
            'titulo' => 'Simulacion creada con exito!',
            'msj' => 'Se ha agregado una simulacion',
            'color' => 'success',
            'modelo' => $simulacionldm,
            'request' => $request->all(),
        ];

    }


public function get_print_simulacion_ldm(Request $request){
            $datos = [
                'simulacionldm' => simulador_ldm::find($request->sldm)
            ];

            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha descargado el formato simple de la simulacion con ID '.$request->sldm,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $pdf = PDF::loadView('simulador.formatos.formato_impresion_simulacion_credito_ldm', $datos);
            $pdf->setPaper('letter', 'portrait');
            return $pdf->download('SimulacionSimpleLDM-'.$request->sldm.'.pdf');
    }


    public function anular_simulacionldm(Request $request){
        $simulacionldm = simulador_ldm::find($request->ID_simulador_ldm);
        $simulacionldm->ID_estado = 2;// DESACTIVADO
        $simulacionldm->save();

        foreach($simulacionldm->simuladorldm_cuotasldm as $simculdm){
            $simculdm->ID_estado = 2;
            $simculdm->save();
        }

        return [
            'titulo' => 'La simulacion fue eliminada',
            'msj' => 'La simulacion fue eliminada',
            'color' => 'success',
            'modelo' => $simulacionldm,
            'request' => $request->all(),
        ];
    }







/*--------------------------- CUOTAS SIMULADOR LDM---------------------------- */


public function get_simulador_cuotas_ldm(Request $request){
        switch ($request->identificador) {
            case 'sim_cuotas_ldm':
            $simcuo = simulador_ldm::find($request->ID_simulador_ldm);
            $simcuo->simuladorldm_cuotasldm->each(function($sim_cuota){
                    $sim_cuota->SCLM_fecha_creacion = Carbon::parse($sim_cuota->SCLM_fecha_creacion)->format('d-m-Y');
                    $sim_cuota->SCLM_fecha_actualizacion = Carbon::parse($sim_cuota->SCLM_fecha_actualizacion)->format('d-m-Y');
                    $sim_cuota->SCLM_fecha_vencimiento = Carbon::parse($sim_cuota->SCLM_fecha_vencimiento)->format('d-m-Y');
                    $sim_cuota->estado;
                    $sim_cuota->userlog = Auth::user()->ID_tipo_usuario;
                    $sim_cuota->SCLM_saldo_ini = 'UF '.number_format($sim_cuota->SCLM_saldo_ini,2,",",".");
                    $sim_cuota->SCLM_valor_cuota = 'UF '.number_format($sim_cuota->SCLM_valor_cuota,2,",",".");
                    $sim_cuota->SCLM_interes = 'UF '.number_format($sim_cuota->SCLM_interes,2,",",".");
                    $sim_cuota->SCLM_capital = 'UF '.number_format($sim_cuota->SCLM_capital,2,",",".");
                    $sim_cuota->SCLM_abono = 'UF '.number_format($sim_cuota->SCLM_abono,2,",",".");
                     

                });
        return [
                    'error' => '',
                    'datos' => $simcuo,
                    'IDsimldm' => $simcuo->ID_simulador_ldm,
                    'nomparcela' => $simcuo->parcelasldm->PLM_nombre,
                    'valoufhoy' => number_format($simcuo->SLM_valorufhoy,2,",","."),
                    'valorlistauf' => 'UF '.number_format($simcuo->parcelasldm->PLM_valor_lista,0,",",".").'.-',
                    'dctooto' => number_format($simcuo->parcelasldm->PLM_descuento,1,",",".").' %',
                    'valorventauf' => 'UF '.number_format($simcuo->parcelasldm->PLM_valor_venta,0,",",".").'.-',
                    'tipocreditosimldm' => (($simcuo->SLM_tipo_credito == 1) ? 'CR&Eacute;DITO TRADICIONAL' : 'CR&Eacute;DITO CUOTA LIVIANA'),
                    'idtipocreditosimldm' => $simcuo->SLM_tipo_credito,
                    'piesolsim' => number_format($simcuo->SLM_pie_solicitado,1,",",".").' %',
                    'pieufldmsim' => 'UF '.number_format($simcuo->SLM_monto_pie,0,",",".").'.-',
                    'piepesosldmsim' => '$ '.number_format($simcuo->SLM_monto_pie_pesos,0,",","."),
                    'numcuotasldmsim' => $simcuo->numcuotassldm->NC_cuotas,
                    'tasaanualsimldm' => number_format($simcuo->SLM_interes_anual,1,",",".").' %',
                    'tasamensualsimldm' => number_format(($simcuo->SLM_interes_mensual*100),2,",",".").' %',
                    'montofinansim' => 'UF '.number_format($simcuo->SLM_cupo_otorgado,2,",",".").'.-',
                    'valorcuotafijasim' => 'UF '.number_format($simcuo->SLM_valor_cuota,2,",",".").'.-',
                    'valorfinalcreditosim' => 'UF '.number_format($simcuo->SLM_monto_pie+$simcuo->SLM_monto_cuota_final+$simcuo->SLM_valor_cuota*$simcuo->numcuotassldm->NC_cuotas,2,",",".").'.-',
                    'coutafinalsimldm' => (($simcuo->SLM_cuota_final == NULL) ? ' ' : number_format($simcuo->SLM_cuota_final,1,",",".").' %'),
                    'montocoutafinalsimldm' => (($simcuo->SLM_monto_cuota_final == NULL) ? ' ' : 'UF '.number_format($simcuo->SLM_monto_cuota_final,0,",",".").'.-'),
                 

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


    public function get_print_simulacion_cuotas_ldm(Request $request){
            $datos = [
                'simulacioncldm' => simulador_ldm::find($request->simcldm)
            ];

            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha descargado el formato dellatado de la simulacion con ID '.$request->simcldm,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $pdf = PDF::loadView('simulador.formatos.formato_impresion_simulacion_cuadro_pagosldm', $datos);
            $pdf->setPaper('letter', 'portrait');
            return $pdf->download('SimulacionCuadroDePagosLDM-'.$request->simcldm.'.pdf');
    }







}

