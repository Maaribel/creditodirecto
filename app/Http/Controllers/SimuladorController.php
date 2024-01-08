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
use App\tasa_anual_proy;
use App\historial;
use Auth;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class SimuladorController extends Controller
{
    
    public function ver_simulador(Request $request){
                                    
        $tasa_anual = tasa_anual_proy::select(DB::raw("CONCAT(TA_nom_proyecto,' - ',TA_tasa_anual) AS nom_proyecto"),'ID_tasa_anual')->where('ID_Estado', 1)->pluck('nom_proyecto','ID_tasa_anual');
        $simulador = simulador::where('ID_Estado',1)->get();

         
      
        return view('simulador.simulador.index')
        ->with('tasa_anual',$tasa_anual)
        ->with('simulador',$simulador)

        ;

    }


    public function nueva_simulacion(Request $request){
        $reglas = [
            'S_nombre_cliente' => 'required',
            'S_nom_parcela' => 'required',
            'S_valor_parcela' => 'required',
        ];
        $attributes = [
            'S_nombre_cliente' => 'cliente',
            'S_nom_parcela' => 'nombre  parcela',
            'S_valor_parcela' => 'valor parcela',
        ];

        $this->validate($request,$reglas,[],$attributes);

        $tasa = tasa_anual_proy::find($request->ID_tasa_anual);

        $simulacion = simulador::create([
              'S_nom_parcela' => $request->S_nom_parcela,
              'S_nombre_cliente' => $request->S_nombre_cliente,
              'S_valor_parcela_uf' => $request->S_valor_parcela_uf,
              'S_uf_hoy' => $request->S_uf_hoy,
              'S_fecha_uf_dia' => Carbon::now()->format('Y-m-d H:i:s'),
              'S_valor_parcela' => $request->S_valor_parcela,
              'S_reserva' => $request->S_reserva,
              'S_pie' => $request->S_pie,
              'S_compraventa' => $request->S_compraventa,
              'S_fecha_inicio_credito' => $request->S_fecha_inicio_credito,
              'S_dia_pago' => Carbon::parse($request->S_fecha_inicio_credito)->format('d'),
              'S_fecha_ultima_cuota' =>Carbon::parse($request->S_fecha_ultima_cuota)->addMonth($request->S_cantidad_cheques),
              'S_cupo_otorgado' => $request->S_cupo_otorgado,
              'S_interes' => ($request->S_cupo_otorgado*((($tasa->TA_tasa_anual)/12)/100)),
              'S_saldo' => (($request->S_cupo_otorgado*((($tasa->TA_tasa_anual)/12)/100))+$request->S_cupo_otorgado),
              'S_cantidad_cheques' => $request->S_cantidad_cheques,
              'ID_tasa_anual' => $tasa->ID_tasa_anual,
              'S_tasa_mensual' =>($tasa->TA_tasa_anual)/12,
              'S_valor_cuota' => (((($tasa->TA_tasa_anual)/12)/100)*($request->S_cupo_otorgado))/(1-(pow((1+((($tasa->TA_tasa_anual)/12)/100)),-$request->S_cantidad_cheques))),
              'ID_estado' => 1,
              'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);
                

            for ($i = 1; $i <= $simulacion->S_cantidad_cheques; $i++) {
                $cuotas_sim = cuotas_sim::create([
                    'ID_simulador' =>$simulacion->ID_simulador,
                    'CTS_nro_cuota' =>$i,
                    'CTS_fecha_vencimiento' => Carbon::parse($request->S_fecha_inicio_credito)->addMonths($i-1), 
                    'CTS_valor_cuota' => (((($tasa->TA_tasa_anual)/12)/100)*($request->S_cupo_otorgado))/(1-(pow((1+((($tasa->TA_tasa_anual)/12)/100)),-$request->S_cantidad_cheques))),
                    'CTS_saldo_ini' => $simulacion->S_saldo,
                    'CTS_capital' => $simulacion->S_saldo -$simulacion->S_valor_cuota,
                    'CTS_interes' => $simulacion->S_interes,
                    'CTS_saldo' => $simulacion->S_saldo,
                    'ID_estado' => 1,
                    'ID_usuario_login'=> Auth::user()->ID_usuario,
                ]);
            }

            foreach($simulacion->simulador_cuotas as $scu){
                $scu->CTS_capital = ($simulacion->simulador_cuotas->min('CTS_saldo') - $scu->CTS_valor_cuota);
                $scu->CTS_interes = ($simulacion->simulador_cuotas->min('CTS_saldo') - $scu->CTS_valor_cuota)*($simulacion->S_tasa_mensual/100);
                $scu->CTS_saldo =  ($simulacion->simulador_cuotas->min('CTS_saldo') - $scu->CTS_valor_cuota) + ($simulacion->simulador_cuotas->min('CTS_saldo') - $scu->CTS_valor_cuota)*($simulacion->S_tasa_mensual/100);
                $scu->CTS_saldo_ini = ($simulacion->simulador_cuotas->min('CTS_saldo'));
                $scu->save();
            }

            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha creado una simulación',
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
           

        return [
            'titulo' => 'Simulacion creado con exito!',
            'msj' => 'Se ha agregado una simulacion',
            'color' => 'success',
            'modelo' => $simulacion,
            'request' => $request->all(),
        ];

    }


    public function get_simulador(Request $request){
        $simulador = simulador::find($request->ID_simulador);
        $simulador->S_fecha_inicio_credito = Carbon::parse( $simulador->S_fecha_inicio_credito)->format('Y-m-d');
        return $simulador;
    }


    public function set_simulador(Request $request){
        $reglas = [
            'EditaSM_S_nombre_cliente' => 'required',
            'EditaSM_S_nom_parcela' => 'required',
            'EditaSM_S_valor_parcela' => 'required',
        ];
        $attributes = [
            'EditaSM_S_nombre_cliente' => 'cliente',
            'EditaSM_S_nom_parcela' => 'nombre  parcela',
            'EditaSM_S_valor_parcela' => 'valor parcela',
        ];
        $this->validate($request,$reglas,[],$attributes);

        $tasa_e = tasa_anual_proy::find($request->EditaSM_ID_tasa_anual);
        
        $simulador = simulador::find($request->EditaSM_ID_simulador);
        $simulador->S_nom_parcela = $request->EditaSM_S_nom_parcela;
        $simulador->S_nombre_cliente = $request->EditaSM_S_nombre_cliente;
        $simulador->S_valor_parcela = $request->EditaSM_S_valor_parcela;
        $simulador->S_reserva = $request->EditaSM_S_reserva;
        $simulador->S_pie = $request->EditaSM_S_pie;
        $simulador->S_compraventa = $request->EditaSM_S_compraventa;
        $simulador->S_fecha_inicio_credito = $request->EditaSM_S_fecha_inicio_credito;
        $simulador->S_dia_pago = Carbon::parse($request->EditaSM_S_fecha_inicio_credito)->format('d');
        $simulador->S_fecha_ultima_cuota = Carbon::parse($request->EditaSM_S_fecha_inicio_credito)->addMonth($request->EditaSM_S_cantidad_cheques);
        $simulador->S_cupo_otorgado = $request->EditaSM_S_cupo_otorgado;
        $simulador->S_cantidad_cheques = $request->EditaSM_S_cantidad_cheques;
        $simulador->ID_tasa_anual = $tasa_e->ID_tasa_anual;
        $simulador->S_tasa_mensual = ($tasa_e->TA_tasa_anual)/12;
        $simulador->S_valor_cuota = (((($tasa_e->TA_tasa_anual)/12)/100)*($request->EditaSM_S_cupo_otorgado))/(1-(pow((1+((($tasa_e->TA_tasa_anual)/12)/100)),-$request->EditaSM_S_cantidad_cheques)));
        $simulador->S_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $simulador->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha modificado la simulación con ID'.$simulador->ID_simulador,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
       
        return [
            'titulo' => 'Simulacion modificada con exito!',
            'msj' => 'Se ha modificado la simulación',
            'color' => 'success',
            'modela' => $simulador,
            'request' => $request->all(),
        ];
    }

    public function get_print_simulacion(Request $request){
            $datos = [
                'simulacion' => simulador::find($request->sim)
            ];

            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha descargado el formato simple de la simulacion con ID '.$request->sim,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $pdf = PDF::loadView('simulador.formatos.formato_impresion_simulacion_credito', $datos);
            $pdf->setPaper('letter', 'portrait');
            return $pdf->download('SimulacionSimple-'.$request->sim.'.pdf');
    }


     public function anular_simulacion(Request $request){
        $simulador = simulador::find($request->ID_simulador);
        $simulador->ID_estado = 2;// DESACTIVADO
        $simulador->save();

        foreach($simulador->simulador_cuotas as $simcu){
            $simcu->ID_estado = 2;
            $simcu->save();
        }

        return [
            'titulo' => 'La simulacion fue eliminada',
            'msj' => 'La simulacion fue eliminada',
            'color' => 'success',
            'modelo' => $simulador,
            'request' => $request->all(),
        ];
    }


/*--------------------------- CUOTAS SIMULADOR ------------------------------------- */


public function get_simulador_cuotas(Request $request){
        switch ($request->identificador) {
            case 'sim_cuotas':
            $simcuo = simulador::find($request->ID_simulador);
            $simcuo->simulador_cuotas->each(function($sim_cuota){
                    $sim_cuota->CTS_fecha_creacion = Carbon::parse($sim_cuota->CTS_fecha_creacion)->format('d-m-Y');
                    $sim_cuota->CTS_fecha_actualizacion = Carbon::parse($sim_cuota->CTS_fecha_actualizacion)->format('d-m-Y');
                    $sim_cuota->CTS_fecha_vencimiento = Carbon::parse($sim_cuota->CTS_fecha_vencimiento)->format('d-m-Y');
                    $sim_cuota->estado;
                    $sim_cuota->userlog = Auth::user()->ID_tipo_usuario;
                    $sim_cuota->CTS_valor_cuota = '$ '.number_format(bcdiv($sim_cuota->CTS_valor_cuota,1),0,",",".");
                    $sim_cuota->CTS_capital = '$ '.number_format($sim_cuota->CTS_capital,0,",",".");
                    $sim_cuota->CTS_interes = '$ '.number_format($sim_cuota->CTS_interes,0,",",".");
                    $sim_cuota->CTS_saldo = '$ '.number_format($sim_cuota->CTS_saldo,0,",",".");
                    

                });
        return [
                    'error' => '',
                    'datos' => $simcuo,
                    'IDsim' => $simcuo->ID_simulador,
                    'valorcuotasim' =>'$'.number_format($simcuo->S_valor_cuota,0,",","."),
                    'numcuotasim' => $simcuo->S_cantidad_cheques,
                    'prestamo' => '$'.number_format($simcuo->S_cupo_otorgado,0,",","."),
                    'tasaanual' => $simcuo->tasa_anual->TA_tasa_anual. '%',
                    'tasamensual' =>  $simcuo->S_tasa_mensual. '%',
                    'totalsim' =>'$'.number_format($simcuo->S_valor_cuota*$simcuo->S_cantidad_cheques,0,",","."),
                    'costosim' =>'$'.number_format(($simcuo->S_valor_cuota*$simcuo->S_cantidad_cheques)-$simcuo->S_cupo_otorgado,0,",","."),
                    'interessim' =>'$'.number_format($simcuo->S_interes,0,",","."),
                    'saldosim' =>'$'.number_format($simcuo->S_saldo,0,",","."),
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


    public function get_print_simulacion_cuotas(Request $request){
            $datos = [
                'simulacionc' => simulador::find($request->simc)
            ];

            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha descargado el formato dellatado de la simulacion con ID '.$request->simc,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $pdf = PDF::loadView('simulador.formatos.formato_impresion_simulacion_credito_detalle', $datos);
            $pdf->setPaper('letter', 'portrait');
            return $pdf->download('SimulacionCuadroDePagos-'.$request->simc.'.pdf');
    }



/*--------------------------- FIN CUOTAS SIMULADOR -------------------------------- */



/*--------------------------- TASA ANUAL ------------------------------------- */

public function ver_tasa_anual(Request $request){
        
        $proyectos = proyectos::where('ID_Estado',1)->pluck('PR_nombre', 'ID_proyecto');
        $simulador = simulador::where('ID_Estado',1)->get();
        $tasa_anual = tasa_anual_proy::where('ID_Estado',1)->get();
      
        return view('mantenedor.tasa_anual.index')
        ->with('proyectos',$proyectos)
        ->with('simulador',$simulador)
        ->with('tasa_anual',$tasa_anual)

        ;

    }

         public function nueva_tasa_anual(Request $request){
        $reglas = [
            'TA_nom_proyecto' => 'required',
            'TA_tasa_anual' => 'required',
        ];
        $attributes = [
            'TA_nom_proyecto' => 'nombre',
            'TA_tasa_anual' => 'rut',
        ];

        $this->validate($request,$reglas,[],$attributes);
 
        $tasa = tasa_anual_proy::create([
                'TA_nom_proyecto' => $request->TA_nom_proyecto,
                'TA_tasa_anual' => $request->TA_tasa_anual,
                'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);
   
        return [
            'titulo' => 'Tasa agregada con exito!',
            'msj' => 'Se ha agregado una Tasa Anual',
            'color' => 'success',
            'modelo' => $tasa,
            'request' => $request->all(),
        ];

    }

    public function get_tasa_anual(Request $request){
        $tasa = tasa_anual_proy::find($request->ID_tasa_anual);
        return $tasa;
    }


    public function set_tasa_anual(Request $request){
         $reglas = [
            'EditaTA_TA_nom_proyecto' => 'required',
            'EditaTA_TA_tasa_anual' => 'required',
        ];
        $attributes = [
            'EditaTA_TA_nom_proyecto' => 'nombre proyecto',
            'EditaTA_TA_tasa_anual' => 'tasa anual',
        ];
        $this->validate($request,$reglas,[],$attributes);
        
        $tasa = tasa_anual_proy::find($request->EditaTA_ID_tasa_anual);
        $tasa->TA_nom_proyecto = $request->EditaTA_TA_nom_proyecto;
        $tasa->TA_tasa_anual = $request->EditaTA_TA_tasa_anual;
        $tasa->TA_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $tasa->save();

        return [
            'titulo' => '¡Tasa Anual Modicada!',
            'msj' => 'Se ha modificado la tasa anual',
            'color' => 'success',
            'modelo' => $tasa,
            'request' => $request->all(),
        ];
    }

    public function anular_tasa_anual(Request $request){
        $tasa_anual = tasa_anual_proy::find($request->ID_tasa_anual);
        $tasa_anual->ID_estado = 2;// DESACTIVADO
        $tasa_anual->save();
        return [
            'titulo' => 'Tasa Anual Eliminada',
            'msj' => 'El tasa fue eliminada.',
            'color' => 'success',
            'modelo' => $tasa_anual,
            'request' => $request->all(),
        ];
    }









   

}

