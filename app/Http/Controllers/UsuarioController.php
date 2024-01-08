<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\usuarios;
use App\estados;
use App\area;
use App\parametros;
use App\tipo_usuario;
use App\menu;
use App\historial_sesiones;
use Carbon\Carbon;
use App\Rules\Rut;
use Auth;
use DB;

class UsuarioController extends Controller
{
    public function ver_usuarios()
    {
        $usuarios = usuarios::whereIn('ID_estado',[1,2])->get();
        $menus = menu::where('ID_Estado',1)->get();
        $tipo_usuario = tipo_usuario::where('ID_estado',1)->pluck('TU_nombre','ID_tipo_usuario');
        $area = area::where('ID_estado',1)->pluck('A_nombre','ID_area');
        return view('mantenedor.usuarios.index')
        ->with('usuarios',$usuarios)
        ->with('menus',$menus)
        ->with('area',$area)
        ->with('tipo_usuario',$tipo_usuario);
    }



    public function nuevo_usuario(Request $request){
        $rut = new Rut;
        $request->U_rut = $rut::formatearRut($request->U_rut);
        $reglas = [
            'U_rut' => ['required','string',$rut],
            'U_nombres' => 'required',
            'U_apellidos' => 'required',
            'U_correo' => 'required|email',
            'U_nombre_usuario'  => 'required|max:20|string|unique:usuarios,U_nombre_usuario',
            'ID_tipo_usuario' => 'required',
            'U_descripcion' => 'max:100',
        ];
        $attributes = [
            'U_rut' => 'Rut Usuario',
            'U_nombres' => 'Nombres Usuario',
            'U_apellidos' => 'Apellidos Usuario',
            'U_correo' => 'Correo Usuario',
            'U_nombre_usuario' => 'Nombre Usuario',
            'ID_tipo_usuario' => 'Tipo Usuario',
            'U_descripcion' => 'Descripcion',
        ];
        $this->validate($request,$reglas,[],$attributes);

        $parametros = parametros::find(1);
        
        $usuario = usuarios::create([
            'U_rut' => $request->U_rut,
            'U_nombres' => $request->U_nombres,
            'U_apellidos' => $request->U_apellidos,
            'U_correo' => $request->U_correo,
            'ID_area' => $request->ID_area,
            'U_nombre_usuario' => $request->U_nombre_usuario,
            'U_contrasena' => Hash::make('Cambiar.' . date('Y')),
            'ID_tipo_usuario' => $request->ID_tipo_usuario,
            'U_fecha_expira' => Carbon::now()->addDays($parametros->P_caduca_contrasena)->format('Y-m-d'),
            'U_dias_expira' => $parametros->P_caduca_contrasena,
            'U_descripcion' => $request->U_descripcion,
        ]);

         if(isset($request->submenus)){
            foreach ($request->submenus as $key => $value) {
                $usuario->submenus()->attach($value);
            }
        }

        return [
            'titulo' => 'Usuario Creado!',
            'msj' => 'Se ha creado un nuevo usuario',
            'color' => 'success',
            'modelo' => $usuario,
            'request' => $request->all(),
        ];
    }



    public function get_usuario(Request $request){
        $usuario = usuarios::find($request->ID_usuario);
        $usuario->submenus;
        return $usuario;
    }


    public function set_usuario(Request $request){
        $parametros = parametros::find(1);
        $reglas = [
            'Edita_U_nombres' => 'required',
            'Edita_U_apellidos' => 'required',
            'Edita_U_correo' => 'required|email',
            'Edita_U_nombre_usuario'  => 'required|string|unique:usuarios,U_nombre_usuario,'.$request->Edita_ID_usuario.',ID_usuario',
            'Edita_ID_tipo_usuario' => 'required',
            'Edita_U_descripcion' => 'max:100',
        ];
        $attributes = [
            'Edita_U_nombres' => 'nombres',
            'Edita_U_apellidos' => 'apellidos',
            'Edita_U_correo' => 'correo',
            'Edita_U_nombre_usuario' => 'nombre de usuario',
            'Edita_U_contrasena' => 'contraseña',
            'Edita_ID_tipo_usuario' => 'tipo de usuario',
            'Edita_U_descripcion' => 'descripcion',
        ];
        $this->validate($request,$reglas,[],$attributes);
       
        $usuario = usuarios::find($request->Edita_ID_usuario);
        $usuario->U_rut = $request->Edita_U_rut;
        $usuario->U_nombres = $request->Edita_U_nombres;
        $usuario->U_apellidos = $request->Edita_U_apellidos;
        $usuario->U_correo = $request->Edita_U_correo;
        $usuario->ID_area = $request->Edita_ID_area;
        $usuario->U_nombre_usuario = $request->Edita_U_nombre_usuario;
        if($request->Edita_U_contrasena != ''){
            $usuario->U_contrasena = Hash::make($request->Edita_U_contrasena);
             $usuario->U_fecha_expira = Carbon::now()->addDays($parametros->P_caduca_contrasena)->format('Y-m-d');
            $usuario->U_dias_expira = $parametros->P_caduca_contrasena;
            $usuario->U_cambiar_contrasena = 2;// 2 => CAMBIADA 1 => CAMBIAR AL INICIAR
        }else{
            
        }
        $usuario->ID_tipo_usuario = $request->Edita_ID_tipo_usuario;
        $usuario->ID_estado = 1;
        $usuario->U_descripcion = $request->Edita_U_descripcion;
        $usuario->U_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        
        $usuario->save();

         $usuario->submenus()->detach();

        if(isset($request->Edita_submenus)){
            foreach ($request->Edita_submenus as $key => $value) {
                $usuario->submenus()->attach($value);
            }
        }

        return [
            'titulo' => 'Usuario Modificado!',
            'msj' => 'El usuario fue modificado.',
            'color' => 'success',
            'modelo' => $usuario,
            'request' => $request->all(),
        ];
    }


    public function delete_usuario(Request $request){
        $usuario = usuarios::find($request->ID_usuario);
        $usuario->ID_estado = 2;// ELIMINADO
        $usuario->U_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $usuario->save();
        return [
            'titulo' => 'Ocultado',
            'msj' => 'El usuario fue ocultado.',
            'color' => 'success',
            'modelo' => $usuario,
            'request' => $request->all(),
        ];
    }


    public function restart_pasword_usuario(Request $request){
        $contrasena = 'Cambiar.' . date('Y');
        $usuario = usuarios::find($request->ID_usuario);
        $usuario->ID_estado = 1;
        $usuario->U_cambiar_contrasena = 1;//1 => CAMBIAR AL INICIAR 2 => CAMBIADA
        $usuario->U_contrasena = Hash::make($contrasena);
        $usuario->U_fecha_expira = Carbon::now()->addDays(4)->format('Y-m-d');
        $usuario->U_fecha_actualizacion = Carbon::now()->format('Y-m-d H:i:s');
        $usuario->save();
        return [
            'titulo' => 'Contraseña Restablecida',
            'msj' => 'Contraseña fue restablecida a ' . $contrasena,
            'color' => 'success',
            'modelo' => $usuario,
            'request' => $request->all(),
        ];
    }


    public function cambiar_mi_password(Request $request){
        $parametros = parametros::find(1);
        //$current_password = new Current_password;
        $reglas = [
            'contrasena' => array(
                'required',
                'confirmed',
                'regex:'.$parametros->P_nivel_contrasena,
                //$current_password
            )
        ];
        $this->validate($request, $reglas);
        $usuario = Auth::user();
        $usuario->U_contrasena = Hash::make($request->contrasena);
        $usuario->U_fecha_expira = Carbon::now()->addDays($parametros->P_caduca_contrasena)->format('Y-m-d H:i:s');
        $usuario->U_cambiar_contrasena = 2;
        $usuario->U_dias_expira = Carbon::parse($usuario->U_fecha_expira)->diffInDays();
        $usuario->save();
        return redirect('/home_admin');
    }


public function ver_historial_sesiones()
    {
        $historials = historial_sesiones::all();
        
        return view('mantenedor.historial_sesiones.index')
       

        ->with('historials',$historials);
    }



}
