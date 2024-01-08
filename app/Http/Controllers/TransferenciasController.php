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
use App\parcelas;
use App\clientes;
use App\usuarios;
use App\historial;
use Auth;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class TransferenciasController extends Controller
{
    
    public function get_parcela_transf(Request $request){
        switch ($request->identificador) {
            case 'transf':
            $parcela = parcelas::find($request->ID_parcela);
            $parcela->parcela_transferencias->each(function($patr){
                    $patr->TR_fecha_creacion = Carbon::parse($patr->TR_fecha_creacion)->format('d-m-Y');
                    $patr->TR_fecha_actualizacion = Carbon::parse($patr->TR_fecha_actualizacion)->format('d-m-Y');
                    $patr->TR_fecha_deposito = Carbon::parse($patr->TR_fecha_deposito)->format('d-m-Y');
                    $patr->TR_monto = number_format($patr->TR_monto);
                    $patr->userlog = Auth::user()->ID_tipo_usuario;
                    $patr->estado;
                    $patr->cuota;
                    $patr->estadotransfer;

                });
        return [
                    'error' => '',
                    'datos' => $parcela,
                    'IDPatr' => $parcela->ID_parcela,
                    'nomPatr' => $parcela->PC_nombre,
                    'valortr' => $parcela->PC_valor_transf,
                    'nom_clitr' => $parcela->cliente->CL_nombre,
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


    public function nueva_transferencia(Request $request){
        $reglas = [
            'TRF_TR_titular' => 'required',
            'TRF_TR_monto' => 'required',
            'TRF_TR_banco' => 'required',
            'TRF_TR_cuenta' => 'required',
            'TRF_TR_numero' => 'required',
            'TRF_TR_fecha_deposito' => 'required',
            'TRF_TR_comprobante' => ['max:500'],
        ];
        $attributes = [
            'TRF_TR_titular' => 'titular',
            'TRF_TR_monto' => 'monto',
            'TRF_TR_banco' => 'datos',
            'TRF_TR_cuenta' => 'datos',
            'TRF_TR_numero' => 'datos',
            'TRF_TR_fecha_deposito' => 'fecha deposito',
            'TRF_TR_comprobante' => 'comprobante',
        ];

        $this->validate($request,$reglas,[],$attributes);

        $parcela = parcelas::find($request->TRF_ID_parcela);

        if ($request->hasFile('TRF_TR_comprobante') != '') {
            if ($request->hasFile('TRF_TR_comprobante')) {
                $transfe = $request->file('TRF_TR_comprobante');
                $adj_transf = date('dmY') . '_' . time() .'_'.$parcela->ID_parcela.'_'. $transfe->getClientOriginalName();

                $transfe->move(storage_path('app/public/transf_adj/'), $adj_transf);
            }
        }else{

            $adj_transf = NULL;
        }
 
        $transfe = transferencias::create([
              'TR_titular' => $request->TRF_TR_titular,
              'TR_monto' => $request->TRF_TR_monto,
              'TR_banco' => $request->TRF_TR_banco,
              'TR_cuenta' => $request->TRF_TR_cuenta,
              'TR_numero' => $request->TRF_TR_numero,
              'TR_fecha_deposito' => $request->TRF_TR_fecha_deposito,
              'TR_comprobante' => $adj_transf,
              'ID_parcela' => $request->TRF_ID_parcela,
              'ID_proyecto' => $parcela->ID_proyecto,
              'ID_proyecto_macro' => $parcela->ID_proyecto_macro,
              'ID_estado_transfer' => 1,
              'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha agregado una transferencia a la parcela con ID '.$transfe->ID_parcela,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
   
        return [
            'modelo' => $transfe,
             'colorTF' => $transfe->estadotransfer->ETF_color,
            'estadoTF' => $transfe->estadotransfer->ETF_nombre,
            'fechacre' => Carbon::parse($transfe->TR_fecha_creacion)->format('d-m-Y'),
            'fechact' => Carbon::parse($transfe->TR_fecha_actualizacion)->format('d-m-Y'),
            'fechadep' => Carbon::parse($transfe->TR_fecha_deposito)->format('d-m-Y'),
            'montoT' => number_format($transfe->TR_monto),
            'request' => $request->all(),
        ];

    }

    public function get_transferencia(Request $request){
        $transfer = transferencias::find($request->ID_transferencia);
        $transfer->TR_fecha_deposito = Carbon::parse($transfer->TR_fecha_deposito)->format('Y-m-d');
        return $transfer;
    }


     public function set_transferencia(Request $request){
         $reglas = [
            'EditaTRF_TR_titular' => 'required',
            'EditaTRF_TR_monto' => 'required',
            'EditaTRF_TR_banco' => 'required',
            'EditaTRF_TR_cuenta' => 'required',
            'EditaTRF_TR_numero' => 'required',
            'EditaTRF_TR_fecha_deposito' => 'required',
            'EditaTRF_comprobante' => ['max:500'],
        ];
        $attributes = [
            'EditaTRF_TR_titular' => 'titular',
            'EditaTRF_TR_monto' => 'monto',
            'EditaTRF_TR_banco' => 'datos',
            'EditaTRF_TR_cuenta' => 'datos',
            'EditaTRF_TR_numero' => 'datos',
            'EditaTRF_TR_fecha_deposito' => 'fecha deposito',
            'EditaTRF_comprobante' => 'comprobante',
        ];
        $this->validate($request,$reglas,[],$attributes);

        $parcela = parcelas::find($request->EditaTRF_ID_parcela);
        
        $transfer = transferencias::find($request->EditaTRF_ID_transferencia);
        $transfer->TR_titular = $request->EditaTRF_TR_titular;
        $transfer->TR_monto = $request->EditaTRF_TR_monto;
        $transfer->TR_banco = $request->EditaTRF_TR_banco;
        $transfer->TR_cuenta = $request->EditaTRF_TR_cuenta;
        $transfer->TR_numero = $request->EditaTRF_TR_numero;
        $transfer->TR_fecha_deposito = Carbon::parse($request->EditaTRF_TR_fecha_deposito)->format('Y-m-d');
        
        if ($request->hasFile('EditaTRF_comprobante') != '') {
            if ($request->hasFile('EditaTRF_comprobante')) {
                $trf = $request->file('EditaTRF_comprobante');
                $adj_transfer = date('dmY') . '_' . time() .'_'.$transfer->ID_parcela.'_'. $trf->getClientOriginalName();

                $trf->move(storage_path('app/public/transf_adj/'), $adj_transfer);
            }

            $transfer->TR_comprobante = $adj_transfer;

        }

        $transfer->ID_proyecto = $parcela->ID_proyecto;
        $transfer->ID_estado_transfer = $request->EditaTRF_ID_estado_transfer;
        $transfer->TR_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $transfer->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha modificado la transferencia con ID '.$transfer->ID_transferencia.' de la parcela con ID '.$transfer->ID_parcela,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
       
        return [
            'modelo' => $transfer,
             'colorTF' => $transfer->estadotransfer->ETF_color,
            'estadoTF' => $transfer->estadotransfer->ETF_nombre,
            'fechacre' => Carbon::parse($transfer->TR_fecha_creacion)->format('d-m-Y'),
            'fechact' => Carbon::parse($transfer->TR_fecha_actualizacion)->format('d-m-Y'),
            'fechadep' => Carbon::parse($transfer->TR_fecha_deposito)->format('d-m-Y'),
            'montoT' => number_format($transfer->TR_monto),
            'request' => $request->all(),
        ];
    }



    public function anular_tranferencia(Request $request){
        $transfer = transferencias::find($request->ID_transferencia);
        $transfer->ID_estado = 2;// DESACTIVADO
        $transfer->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha anulado la transferencia con ID '.$transfer->ID_cheque.' de la parcela con ID '.$transfer->ID_parcela,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return [
            'modelo' => $transfer,
            'request' => $request->all(),
        ];
    }








  

   

}

