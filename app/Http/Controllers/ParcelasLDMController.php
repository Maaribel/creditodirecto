<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\estado_cuota;
use App\estado_cheque;
use App\proyectos;
use App\parcelas_lista_ldm;
use App\usuarios;
use App\historial;
use Auth;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class ParcelasLDMController extends Controller
{
    
     public function ver_parcelas_ldm(Request $request){
        
        $parcelasLDM = parcelas_lista_ldm::where('ID_Estado',1)->get();

        return view('mantenedor.parcelas_ldm.index')
        ->with('parcelasLDM',$parcelasLDM)
 
        ;

    }

    public function nueva_parcela_ldm(Request $request){
        $reglas = [
            'PLM_nombre' => 'required',
            'PLM_valor_lista' => 'required',
        ];
        $attributes = [
            'PLM_nombre' => 'nombre',
            'PLM_valor_lista' => 'valor',
        ];

        $this->validate($request,$reglas,[],$attributes);
 
        $parldm = parcelas_lista_ldm::create([
                'PLM_nombre' => $request->PLM_nombre,
                'PLM_valor_lista' => $request->PLM_valor_lista,
                'PLM_descuento' => $request->PLM_descuento,
                'PLM_valor_venta' => $request->PLM_valor_venta,
                'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);
   
        return [
            'titulo' => 'Parcelas ingresada con exito!',
            'msj' => 'Se ha agregado una nueva parcela',
            'color' => 'success',
            'modelo' => $parldm,
            'request' => $request->all(),
        ];

    }

    public function get_parcela_ldm(Request $request){
        $parldm = parcelas_lista_ldm::find($request->ID_parcelas_lista_ldm);
        return $parldm;
    }

     public function set_parcela_ldm(Request $request){
             $reglas = [
                'EditaPLDM_PLM_nombre' => 'required',
                'EditaPLDM_PLM_valor_lista' => 'required',
            ];
            $attributes = [
                'EditaPLDM_PLM_nombre' => 'nombre',
                'EditaPLDM_PLM_valor_lista' => 'tasa anual',
            ];
            $this->validate($request,$reglas,[],$attributes);
            
            $parldm = parcelas_lista_ldm::find($request->EditaPLDM_ID_parcelas_lista_ldm);
            $parldm->PLM_nombre = $request->EditaPLDM_PLM_nombre;
            $parldm->PLM_valor_lista = $request->EditaPLDM_PLM_valor_lista;
            $parldm->PLM_descuento = $request->EditaPLDM_PLM_descuento;
            $parldm->PLM_valor_venta = $request->EditaPLDM_PLM_valor_venta;
            $parldm->PLM_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
            $parldm->save();

            return [
                'titulo' => '¡Parcela Modicada!',
                'msj' => 'Se ha modificado la parcela',
                'color' => 'success',
                'modelo' => $parldm,
                'request' => $request->all(),
            ];
        }


    public function anular_parcela_ldm(Request $request){
        $parldm = parcelas_lista_ldm::find($request->ID_parcelas_lista_ldm);
        $parldm->ID_estado = 2;// DESACTIVADO
        $parldm->save();
        return [
            'titulo' => 'Parcela Eliminada',
            'msj' => 'El Parcela fue eliminada.',
            'color' => 'success',
            'modelo' => $parldm,
            'request' => $request->all(),
        ];
    }

    








    

}
