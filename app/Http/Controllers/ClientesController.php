<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cheques;
use App\estado_cheque;
use App\comp_pago;
use App\proyectos;
use App\proyectos_macro;
use App\parcelas;
use App\clientes;
use App\adj_clientes;
use App\usuarios;
use App\historial;
use Auth;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ClientesController extends Controller
{
    public function ver_clientes(Request $request){
        
        $clientes = clientes::where('ID_Estado',1)->get();
        $proyectos = proyectos::where('ID_Estado',1)->pluck('PR_nombre','ID_proyecto');
        $proymacro = proyectos_macro::where('ID_estado',1)->pluck('PRM_nombre','ID_proyecto_macro');
        
        return view('proyectos.clientes.index')
        ->with('clientes',$clientes)
        ->with('proymacro',$proymacro)
        ->with('proyectos',$proyectos)
        ;

    }

     public function nuevo_cliente(Request $request){
        $reglas = [
            'CL_nombre' => 'required',
            'CL_rut' => 'required',
        ];
        $attributes = [
            'CL_nombre' => 'nombre',
            'CL_rut' => 'rut',
        ];

        $this->validate($request,$reglas,[],$attributes);
 
        $cliente = clientes::create([
                'ID_proyecto_macro' => $request->ID_proyecto_macro,
                'ID_proyecto' => $request->ID_proyecto,
                'CL_nombre' => $request->CL_nombre,
                'CL_rut' => $request->CL_rut,
                'CL_telefono' => $request->CL_telefono,
                'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha creado el cliente '.$cliente->CL_nombre.' al Proyecto con ID '.$cliente->ID_proyecto,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
   
        return [
            'titulo' => 'Cliente agregado con exito!',
            'msj' => 'Se ha agregado un nuevo cliente',
            'color' => 'success',
            'modelo' => $cliente,
            'request' => $request->all(),
        ];

    }

    public function get_cliente(Request $request){
        $cliente = clientes::find($request->ID_cliente);
        return $cliente;
    }


    public function set_cliente(Request $request){
         $reglas = [
            'EditaC_CL_nombre' => 'required',
            'EditaC_CL_rut' => 'required',
        ];
        $attributes = [
            'EditaC_CL_nombre' => 'nombre',
            'EditaC_CL_rut' => 'rut',
        ];
        $this->validate($request,$reglas,[],$attributes);
        
        $clientes = clientes::find($request->EditaC_ID_cliente);
        $clientes->ID_proyecto = $request->EditaC_ID_proyecto;
        $clientes->CL_nombre = $request->EditaC_CL_nombre;
        $clientes->CL_rut = $request->EditaC_CL_rut;
        $clientes->CL_telefono = $request->EditaC_CL_telefono;
        $clientes->CL_correo = $request->EditaC_CL_correo;
        $clientes->CL_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $clientes->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha modificado el cliente '.$clientes->CL_nombre.' del Proyecto con ID '.$clientes->ID_proyecto,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return [
            'titulo' => '¡Cliente Modicado!',
            'msj' => 'Se ha modificado el cliente',
            'color' => 'success',
            'modelo' => $clientes,
            'request' => $request->all(),
        ];
    }

    public function anular_cliente(Request $request){
        $clientes = clientes::find($request->ID_cliente);
        $clientes->ID_estado = 2;// DESACTIVADO
        $clientes->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha desactivado el cliente '.$clientes->CL_nombre.' del Proyecto con ID '.$clientes->ID_proyecto,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        return [
            'titulo' => 'Cliente Eliminado',
            'msj' => 'El cliente fue eliminado.',
            'color' => 'success',
            'modelo' => $clientes,
            'request' => $request->all(),
        ];
    }



//------------------------DOCUMENTOS CLIENTES--------------------------------//


public function get_cliente_docx(Request $request){
        switch ($request->identificador) {
            case 'documentos':
            $clie = clientes::find($request->ID_cliente);
            $clie->cliente_docx->each(function($cli_doc){
                    $cli_doc->ACL_fecha_creacion = Carbon::parse($cli_doc->ACL_fecha_creacion)->format('d-m-Y');
                    $cli_doc->ACL_fecha_actualizacion = Carbon::parse($cli_doc->ACL_fecha_actualizacion)->format('d-m-Y');
                    $cli_doc->estado;

                });
        return [
                    'error' => '',
                    'datos' => $clie,
                    'IDCL' => $clie->ID_cliente,
                    'nomCL' => $clie->CL_nombre,
                ];
            break;

            default:
                return [
                    'error' => 'Identificador fuera de rango.'
                ];
            break;

        }
    }

    public function nuevo_documento(Request $request){
        $reglas = [
            'CLD_ACL_nombre' => 'required',
        ];
        $attributes = [
            'CLD_ACL_nombre' => 'nombre doc',
        ];

        $this->validate($request,$reglas,[],$attributes);

        $cliente = clientes::find($request->CLD_ID_cliente);

        if ($request->hasFile('CLD_ACL_ruta') != '') {
            if ($request->hasFile('CLD_ACL_ruta')) {
                $docx = $request->file('CLD_ACL_ruta');
                $docx_cl = date('dmY') . '_' . time() .'_'. $docx->getClientOriginalName();

                $docx->move(storage_path('app/public/clientes_adj/'), $docx_cl);
            }
        }else{

            $docx_cl = NULL;
        }
 
        $docx = adj_clientes::create([
              'ID_cliente' => $cliente->ID_cliente,
              'ACL_nombre' => $request->CLD_ACL_nombre,
              'ACL_ruta' => $docx_cl,
              'ID_estado' => 1,
              'ID_usuario_login'=> Auth::user()->ID_usuario,
        ]);

         $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha agregado un documento de nombre '.$docx->ACL_nombre.' al cliente con ID '.$docx->ID_cliente,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
   
        return [
            'modelo' => $docx,
            'estado' => $docx->estado->E_nombre,
            'fechacre' => Carbon::parse($docx->ACL_fecha_creacion)->format('d-m-Y'),
            'fechact' => Carbon::parse($docx->ACL_fecha_actualizacion)->format('d-m-Y'),
            'request' => $request->all(),
        ];

    }

     public function get_documento(Request $request){
        $docx = adj_clientes::find($request->ID_adj_cliente);
        return $docx;
    }


    public function set_documentos(Request $request){
         $reglas = [
            'EditaCLD_ACL_nombre' => 'required',
        ];
        $attributes = [
            'EditaCLD_ACL_nombre' => 'titular',
        ];
        $this->validate($request,$reglas,[],$attributes);
        
        $docx = adj_clientes::find($request->EditaCLD_ID_adj_cliente);
        $docx->ACL_nombre = $request->EditaCLD_ACL_nombre;
        
        if ($request->hasFile('EditaCLD_ruta') != '') {
            if ($request->hasFile('EditaCLD_ruta')) {
                $docx1 = $request->file('EditaCLD_ruta');
                $docx_cle = date('dmY') . '_' . time() .'_'. $docx1->getClientOriginalName();

                $docx1->move(storage_path('app/public/clientes_adj/'), $docx_cle);
            }
            $docx->ACL_ruta = $docx_cle;
        }

        $docx->ACL_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $docx->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha modificado el documento '.$docx->ACL_nombre.' del cliente con ID '.$docx->ID_cliente,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
       
        return [
            'modelo' => $docx,
             'estado' => $docx->estado->E_nombre,
            'fechacre' => Carbon::parse($docx->ACL_fecha_creacion)->format('d-m-Y'),
            'fechact' => Carbon::parse($docx->ACL_fecha_actualizacion)->format('d-m-Y'),
            'request' => $request->all(),
        ];
    }

    public function anular_documentos(Request $request){
        $docx = adj_clientes::find($request->ID_adj_cliente);
        $docx->ID_estado = 2;// DESACTIVADO
        $docx->save();

        $historial = historial::create([
              'ID_usuario'=> Auth::user()->ID_usuario,
              'H_accion' => 'El usuario '.Auth::user()->U_nombre_usuario. ' ha desactivado el documento '.$docx->ACL_nombre.' del cliente con ID '.$docx->ID_cliente,
              'H_fecha_creacion' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        return [
            'modelo' => $docx,
            'request' => $request->all(),
        ];
    }















}