<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cheques;
use App\transferecias;
use App\cheques_reb;
use App\cuotas;
use App\estado_cuota;
use App\estado_cheque;
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

class ChequesController extends Controller
{
    
    public function get_parcela_cheque(Request $request){
        switch ($request->identificador) {
            case 'cheque':
            $parcela = parcelas::find($request->ID_parcela);
            $parcela->parcela_cheque->each(function($pach){
                    $pach->CHQ_fecha_creacion = Carbon::parse($pach->CHQ_fecha_creacion)->format('d-m-Y');
                    $pach->CHQ_fecha_actualizacion = Carbon::parse($pach->CHQ_fecha_actualizacion)->format('d-m-Y');
                    $pach->CHQ_fecha_deposito = Carbon::parse($pach->CHQ_fecha_deposito)->format('d-m-Y');
                    $pach->CHQ_monto = number_format($pach->CHQ_monto);
                    $pach->userlog = Auth::user()->ID_tipo_usuario;
                    $pach->estado;
                    $pach->estado_chq;
                    $pach->cuota;

                });
            $parcela->cliente;
        return [
                    'error' => '',
                    'datos' => $parcela,
                    'IDPa' => $parcela->ID_parcela,
                    'nomPa' => $parcela->PC_nombre,
                    'valorC' => $parcela->PC_valor_cuota,
                    'nom_cli' => $parcela->cliente->CL_nombre,
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



    public function nuevo_cheque(Request $request){
        $reglas = [
            'CHE_CHQ_titular' => 'required',
            'CHE_CHQ_monto' => 'required',
            'CHE_CHQ_banco' => 'required',
            'CHE_CHQ_nro_cuenta' => 'required',
            'CHE_CHQ_nro_serie' => 'required',
            'CHE_CHQ_fecha_deposito' => 'required',
            'CHE_CHQ_adjunto' =>  ['max:500'],
            'CHE_CHQ_adjunto_comp' => ['max:500'],
        ];
        $attributes = [
            'CHE_CHQ_titular' => 'titular',
            'CHE_CHQ_monto' => 'monto',
            'CHE_CHQ_banco' => 'datos',
            'CHE_CHQ_nro_cuenta' => 'datos',
            'CHE_CHQ_nro_serie' => 'datos',
            'CHE_CHQ_fecha_deposito' => 'fecha deposito',
            'CHE_CHQ_adjunto' => 'cheque',
            'CHE_CHQ_adjunto_comp' => 'comprobante',
        ];

        $this->validate($request,$reglas,[],$attributes);

        $parcela = parcelas::find($request->CHE_ID_parcela);

        if ($request->hasFile('CHE_CHQ_adjunto') != '') {
            if ($request->hasFile('CHE_CHQ_adjunto')) {
                $cheque = $request->file('CHE_CHQ_adjunto');
                $adj_cheque = date('dmY') . '_' . time() .'_'.$parcela->ID_parcela.'_'. $cheque->getClientOriginalName();

                $cheque->move(storage_path('app/public/cheques_adj/'), $adj_cheque);
            }
        }else{

            $adj_cheque = NULL;
        }

        if ($request->hasFile('CHE_CHQ_adjunto_comp') != '') {
            if ($request->hasFile('CHE_CHQ_adjunto_comp')) {
                $cheque = $request->file('CHE_CHQ_adjunto_comp');
                $adj_cheque_comp = date('dmY') . '_' . time() .'_Comp_'. $cheque->getClientOriginalName();

                $cheque->move(storage_path('app/public/cheques_adj/comprobantes/'), $adj_cheque_comp);
            }
        }else{

            $adj_cheque_comp= NULL;
        }
 
        $cheque = cheques::create([
              'CHQ_titular' => $request->CHE_CHQ_titular,
              'CHQ_monto' => $request->CHE_CHQ_monto,
              'ID_cuota' => $request->CHE_ID_cuota,
              'CHQ_banco' => $request->CHE_CHQ_banco,
              'CHQ_nro_cuenta' => $request->CHE_CHQ_nro_cuenta,
              'CHQ_nro_serie' => $request->CHE_CHQ_nro_serie,
              'CHQ_fecha_deposito' => $request->CHE_CHQ_fecha_deposito,
              'CHQ_comprobante_dep' => $request->CHE_CHQ_comprobante_dep,
              'CHQ_adjunto' => $adj_cheque,
              'CHQ_adjunto_comp' => $adj_cheque_comp,
              'ID_parcela' => $request->CHE_ID_parcela,
              'ID_proyecto' => $parcela->ID_proyecto,
              'ID_proyecto_macro' => $parcela->ID_proyecto_macro,
              'ID_estado_cheque' => 1,
              'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);


        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha agregado un cheque a la parcela con ID '.$cheque->ID_parcela,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
   
        return [
            'modelo' => $cheque,
            'estadoCHQ' => $cheque->estado_chq->ECH_nombre,
            'cuotanom' => $cheque->cuota->CT_nro_cuota,
            'colorECH' => $cheque->estado_chq->ECH_color,
            'fechacre' => Carbon::parse($cheque->CHQ_fecha_creacion)->format('d-m-Y'),
            'fechact' => Carbon::parse($cheque->CHQ_fecha_actualizacion)->format('d-m-Y'),
            'fechadep' => Carbon::parse($cheque->CHQ_fecha_deposito)->format('d-m-Y'),
            'monto' => number_format($cheque->CHQ_monto),
            'request' => $request->all(),
        ];

    }

    public function get_cheque(Request $request){
        $cheques = cheques::find($request->ID_cheque);
        $cheques->CHQ_fecha_deposito = Carbon::parse($cheques->CHQ_fecha_deposito)->format('Y-m-d');
        return $cheques;
    }


     public function set_cheque(Request $request){
         $reglas = [
            'EditaCHE_CHQ_titular' => 'required',
            'EditaCHE_CHQ_monto' => 'required',
            'EditaCHE_CHQ_banco' => 'required',
            'EditaCHE_CHQ_nro_cuenta' => 'required',
            'EditaCHE_CHQ_nro_serie' => 'required',
            'EditaCHE_CHQ_fecha_deposito' => 'required',
            'EditaCHE_adjunto' =>  ['max:500'],
            'EditaCHE_adjunto_comp' => ['max:500'],
        ];
        $attributes = [
            'EditaCHE_CHQ_titular' => 'titular',
            'EditaCHE_CHQ_monto' => 'monto',
            'EditaCHE_CHQ_banco' => 'datos',
            'EditaCHE_CHQ_nro_cuenta' => 'datos',
            'EditaCHE_CHQ_nro_serie' => 'datos',
            'EditaCHE_CHQ_fecha_deposito' => 'fecha deposito',
            'EditaCHE_adjunto' => 'cheque',
            'EditaCHE_adjunto_comp' => 'comprobante',
        ];
        $this->validate($request,$reglas,[],$attributes);

        $parcela = parcelas::find($request->EditaCHE_ID_parcela);
        
        $cheque = cheques::find($request->EditaCHE_ID_cheque);
        $cheque->CHQ_titular = $request->EditaCHE_CHQ_titular;
        $cheque->CHQ_monto = $request->EditaCHE_CHQ_monto;
        $cheque->ID_cuota = $request->EditaCHE_ID_cuota;
        $cheque->CHQ_banco = $request->EditaCHE_CHQ_banco;
        $cheque->CHQ_nro_cuenta = $request->EditaCHE_CHQ_nro_cuenta;
        $cheque->CHQ_nro_serie = $request->EditaCHE_CHQ_nro_serie;
        $cheque->CHQ_fecha_deposito = Carbon::parse($request->EditaCHE_CHQ_fecha_deposito)->format('Y-m-d');
        $cheque->CHQ_comprobante_dep = $request->EditaCHE_CHQ_comprobante_dep;
        
        if ($request->hasFile('EditaCHE_adjunto') != '') {
            if ($request->hasFile('EditaCHE_adjunto')) {
                $chq = $request->file('EditaCHE_adjunto');
                $adj_cheque = date('dmY') . '_' . time() .'_'.$cheque->ID_parcela.'_'. $chq->getClientOriginalName();

                $chq->move(storage_path('app/public/cheques_adj/'), $adj_cheque);
            }

            $cheque->CHQ_adjunto = $adj_cheque;

        }

         if ($request->hasFile('EditaCHE_adjunto_comp') != '') {
            if ($request->hasFile('EditaCHE_adjunto_comp')) {
                $chq1 = $request->file('EditaCHE_adjunto_comp');
                $adj_cheque_comp = date('dmY') . '_' . time() .'_Comp_'. $chq1->getClientOriginalName();

                $chq1->move(storage_path('app/public/cheques_adj/comprobantes/'), $adj_cheque_comp);
            }

            $cheque->CHQ_adjunto_comp = $adj_cheque_comp;

        }

        $cheque->ID_proyecto = $parcela->ID_proyecto;

        if($request->EditaCHE_ID_estado_cheque == 3){
            $cheque->ID_estado_cheque = $request->EditaCHE_ID_estado_cheque;
            $cheque_reb = cheques_reb::create([
                'ID_cheque' => $request->EditaCHE_ID_cheque,
                'CR_monto_cheque' => $request->EditaCHE_CHQ_monto,
                'ID_proyecto' => $parcela->ID_proyecto,
                'ID_proyecto_macro' => $parcela->ID_proyecto_macro,
                'CR_fecha_rebote' => Carbon::now()->format('Y-m-d H:i:s'),
                'ID_estado' => 1,
                'ID_usuario_login'=> Auth::user()->ID_usuario,
            ]);

            $cuotas_ch = cuotas::find($request->EditaCHE_ID_cuota);
            $cuotas_ch->ID_estado_cuota = 2;
            $cuotas_ch->save();

            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha prostestado el cheque con ID '.$cheque->ID_cheque.' de la parcela con ID '.$cheque->ID_parcela,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        }else{
            $cheque->ID_estado_cheque = $request->EditaCHE_ID_estado_cheque;
        }

        if($request->EditaCHE_ID_estado_cheque == 4){
            $cheque->ID_estado_cheque = $request->EditaCHE_ID_estado_cheque;
                $cuotas_ch = cuotas::find($request->EditaCHE_ID_cuota);
                $cuotas_ch->ID_estado_cuota = 3;
                $cuotas_ch->CT_fecha_pago = Carbon::now()->format('Y-m-d H:i:s');
                $cuotas_ch->save();

            $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha pagado el cheque con ID '.$cheque->ID_cheque.' de la parcela con ID '.$cheque->ID_parcela,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);


        }else{
            $cheque->ID_estado_cheque = $request->EditaCHE_ID_estado_cheque;
        }

        $cheque->CHQ_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $cheque->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha modificado el cheque con ID '.$cheque->ID_cheque.' de la parcela con ID '.$cheque->ID_parcela,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
       
        return [
            'modelo' => $cheque,
            'estadoCHQ' => $cheque->estado_chq->ECH_nombre,
            'cuotanom' => $cheque->cuota->CT_nro_cuota,
            'colorECH' => $cheque->estado_chq->ECH_color,
            'fechacre' => Carbon::parse($cheque->CHQ_fecha_creacion)->format('d-m-Y'),
            'fechact' => Carbon::parse($cheque->CHQ_fecha_actualizacion)->format('d-m-Y'),
            'fechadep' => Carbon::parse($cheque->CHQ_fecha_deposito)->format('d-m-Y'),
            'monto' => number_format($cheque->CHQ_monto),
            'request' => $request->all(),
        ];
    }

    public function anular_cheque(Request $request){
        $cheque = cheques::find($request->ID_cheque);
        $cheque->ID_estado = 2;// DESACTIVADO
        $cheque->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha anulado el cheque con ID '.$cheque->ID_cheque.' de la parcela con ID '.$cheque->ID_parcela,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return [
            'modelo' => $cheque,
            'request' => $request->all(),
        ];
    }








  

   

}

