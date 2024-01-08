<?php

Route::get('/', function () {
    if(Auth::user()->U_cambiar_contrasena == 1){
        return redirect()->route('cambiar_mi_contrasena');
    }
    return view('home_admin');
})->middleware('auth');

Route::get('/clear-site', function() {
	echo "limpiando el sitio...";
	Artisan::call('config:cache');
	Artisan::call('config:clear');
	Artisan::call('cache:clear');
	Artisan::call('view:cache');
	Artisan::call('view:clear');
	Artisan::call('route:clear');
	echo 'el sitio se limpio correctamente';
});

Auth::routes();

Route::get('\home_admin', 'HomeAdminController@index')->name('home_admin');

Route::group(['prefix' => 'mantenedor','middleware'=>'auth'],function(){	
	Route::get('usuarios',[
		'uses'	=> 'UsuarioController@ver_usuarios',
		'as'	=> 'ver_usuarios'
	]);

	Route::post('usuarios/nuevo_usuario',[
		'uses'	=> 'UsuarioController@nuevo_usuario',
		'as'	=> 'nuevo_usuario'
	]);

	Route::post('usuarios/get_usuario',[
		'uses'	=> 'UsuarioController@get_usuario',
		'as'	=> 'get_usuario'
	]);

	Route::post('usuarios/set_usuario',[
		'uses'	=> 'UsuarioController@set_usuario',
		'as'	=> 'set_usuario'
	]);

	Route::post('usuarios/restart_pasword_usuario',[
		'uses'	=> 'UsuarioController@restart_pasword_usuario',
		'as'	=> 'restart_pasword_usuario'
	]);

	Route::post('usuarios/delete_usuario',[
		'uses'	=> 'UsuarioController@delete_usuario',
		'as'	=> 'delete_usuario'
	]);

	Route::get('usuarios/cambiar_mi_contrasena',function(){
		return view('mantenedor.usuarios.cambiar_mi_contrasena');
	})->name('cambiar_mi_contrasena');

	Route::post('usuarios/cambiar_mi_password',[
		'uses'	=> 'UsuarioController@cambiar_mi_password',
		'as'	=> 'cambiar_mi_password'
	]);


Route::get('historial_sesiones',[
		'uses'	=> 'UsuarioController@ver_historial_sesiones',
		'as'	=> 'ver_historial_sesiones'
	]);



	Route::get('tasa_anual',[
		'uses'	=> 'SimuladorController@ver_tasa_anual',
		'as'	=> 'ver_tasa_anual'
	]);

	Route::post('tasa_anual/nueva_tasa_anual',[
		'uses'	=> 'SimuladorController@nueva_tasa_anual',
		'as'	=> 'nueva_tasa_anual'
	]);

	Route::post('tasa_anual/get_tasa_anual',[
		'uses'	=> 'SimuladorController@get_tasa_anual',
		'as'	=> 'get_tasa_anual'
	]);

	Route::post('tasa_anual/set_tasa_anual',[
		'uses'	=> 'SimuladorController@set_tasa_anual',
		'as'	=> 'set_tasa_anual'
	]);

	Route::post('tasa_anual/anular_tasa_anual',[
		'uses'	=> 'SimuladorController@anular_tasa_anual',
		'as'	=> 'anular_tasa_anual'
	]);



	Route::get('parcelas_ldm',[
		'uses'	=> 'ParcelasLDMController@ver_parcelas_ldm',
		'as'	=> 'ver_parcelas_ldm'
	]);

	Route::post('parcelas_ldm/nueva_parcela_ldm',[
		'uses'	=> 'ParcelasLDMController@nueva_parcela_ldm',
		'as'	=> 'nueva_parcela_ldm'
	]);

	Route::post('parcelas_ldm/get_parcela_ldm',[
		'uses'	=> 'ParcelasLDMController@get_parcela_ldm',
		'as'	=> 'get_parcela_ldm'
	]);

	Route::post('parcelas_ldm/set_parcela_ldm',[
		'uses'	=> 'ParcelasLDMController@set_parcela_ldm',
		'as'	=> 'set_parcela_ldm'
	]);

	Route::post('parcelas_ldm/anular_parcela_ldm',[
		'uses'	=> 'ParcelasLDMController@anular_parcela_ldm',
		'as'	=> 'anular_parcela_ldm'
	]);


});


Route::group(['prefix' => 'proyectos','middleware'=>'auth'],function(){
	
	Route::get('clientes',[
		'uses'	=> 'ClientesController@ver_clientes',
		'as'	=> 'ver_clientes'
	]);

	Route::post('clientes/nuevo_cliente',[
		'uses'	=> 'ClientesController@nuevo_cliente',
		'as'	=> 'nuevo_cliente'
	]);

	Route::post('clientes/get_cliente',[
		'uses'	=> 'ClientesController@get_cliente',
		'as'	=> 'get_cliente'
	]);

	Route::post('clientes/set_cliente',[
		'uses'	=> 'ClientesController@set_cliente',
		'as'	=> 'set_cliente'
	]);

	Route::post('clientes/anular_cliente',[
		'uses'	=> 'ClientesController@anular_cliente',
		'as'	=> 'anular_cliente'
	]);

	Route::post('clientes/get_cliente_par',[
		'uses'	=> 'ClientesController@get_cliente_par',
		'as'	=> 'get_cliente_par'
	]);

	Route::post('clientes/get_cliente_info',[
		'uses'	=> 'ClientesController@get_cliente_info',
		'as'	=> 'get_cliente_info'
	]);




	Route::post('doc_clientes/get_cliente_docx',[
		'uses'	=> 'ClientesController@get_cliente_docx',
		'as'	=> 'get_cliente_docx'
	]);

	Route::post('doc_clientes/nuevo_documento',[
		'uses'	=> 'ClientesController@nuevo_documento',
		'as'	=> 'nuevo_documento'
	]);

	Route::post('doc_clientes/get_documento',[
		'uses'	=> 'ClientesController@get_documento',
		'as'	=> 'get_documento'
	]);

	Route::post('doc_clientes/set_documentos',[
		'uses'	=> 'ClientesController@set_documentos',
		'as'	=> 'set_documentos'
	]);

	Route::post('doc_clientes/anular_documentos',[
		'uses'	=> 'ClientesController@anular_documentos',
		'as'	=> 'anular_documentos'
	]);






	Route::get('proyectos',[
		'uses'	=> 'ProyectosController@ver_proyectos',
		'as'	=> 'ver_proyectos'
	]);

	Route::get('crucelosavellanos',[
		'uses'	=> 'ProyectosController@ver_proyectos_cla',
		'as'	=> 'ver_proyectos_cla'
	]);

	Route::post('proyectos/nuevo_proyecto',[
		'uses'	=> 'ProyectosController@nuevo_proyecto',
		'as'	=> 'nuevo_proyecto'
	]);

	Route::post('proyectos/get_proyecto',[
		'uses'	=> 'ProyectosController@get_proyecto',
		'as'	=> 'get_proyecto'
	]);

	Route::post('proyectos/set_proyecto',[
		'uses'	=> 'ProyectosController@set_proyecto',
		'as'	=> 'set_proyecto'
	]);

	Route::post('proyectos/anular_proyecto',[
		'uses'	=> 'ProyectosController@anular_proyecto',
		'as'	=> 'anular_proyecto'
	]);

	Route::post('proyectos/get_flujo_proyecto',[
		'uses'	=> 'ProyectosController@get_flujo_proyecto',
		'as'	=> 'get_flujo_proyecto'
	]);

	Route::get('proyectos/get_print_flujo_proyecto/{idp}',[
		'uses'	=> 'ProyectosController@get_print_flujo_proyecto',
		'as'	=> 'get_print_flujo_proyecto'
	]);




Route::post('parcelas/get_proyecto_parcela',[
		'uses'	=> 'ParcelasController@get_proyecto_parcela',
		'as'	=> 'get_proyecto_parcela'
	]);

Route::post('parcelas/nueva_parcela',[
		'uses'	=> 'ParcelasController@nueva_parcela',
		'as'	=> 'nueva_parcela'
	]);

Route::post('parcelas/get_parcela',[
		'uses'	=> 'ParcelasController@get_parcela',
		'as'	=> 'get_parcela'
	]);

Route::post('parcelas/set_parcela',[
		'uses'	=> 'ParcelasController@set_parcela',
		'as'	=> 'set_parcela'
	]);

Route::post('parcelas/anular_parcela',[
		'uses'	=> 'ParcelasController@anular_parcela',
		'as'	=> 'anular_parcela'
	]);

Route::post('parcelas/terminar_parcela',[
		'uses'	=> 'ParcelasController@terminar_parcela',
		'as'	=> 'terminar_parcela'
	]);

Route::post('parcelas/get_resumen_parcela',[
		'uses'	=> 'ParcelasController@get_resumen_parcela',
		'as'	=> 'get_resumen_parcela'
	]);

Route::get('parcelas/get_print_resumen_parcela/{id}',[
		'uses'	=> 'ParcelasController@get_print_resumen_parcela',
		'as'	=> 'get_print_resumen_parcela'
	]);


Route::get('parcelas/export_parcelas_ple',[
			'uses' => 'ParcelasController@export_parcelas_ple',
			'as'	=> 'export_parcelas_ple'
		]);

Route::get('parcelas/export_parcelas_cla',[
			'uses' => 'ParcelasController@export_parcelas_cla',
			'as'	=> 'export_parcelas_cla'
		]);



Route::post('parcelas/get_parcela_cuotas',[
		'uses'	=> 'ParcelasController@get_parcela_cuotas',
		'as'	=> 'get_parcela_cuotas'
	]);

Route::post('parcelas/get_cuota',[
		'uses'	=> 'ParcelasController@get_cuota',
		'as'	=> 'get_cuota'
	]);

Route::post('parcelas/set_cuota',[
		'uses'	=> 'ParcelasController@set_cuota',
		'as'	=> 'set_cuota'
	]);

Route::post('parcelas/anular_cuota',[
		'uses'	=> 'ParcelasController@anular_cuota',
		'as'	=> 'anular_cuota'
	]);

Route::get('parcelas/get_print_cuadro_pagos/{cp}',[
		'uses'	=> 'ParcelasController@get_print_cuadro_pagos',
		'as'	=> 'get_print_cuadro_pagos'
	]);





Route::post('cheques/get_parcela_cheque',[
		'uses'	=> 'ChequesController@get_parcela_cheque',
		'as'	=> 'get_parcela_cheque'
	]);

Route::post('cheques/nuevo_cheque',[
		'uses'	=> 'ChequesController@nuevo_cheque',
		'as'	=> 'nuevo_cheque'
	]);

Route::post('cheques/get_cheque',[
		'uses'	=> 'ChequesController@get_cheque',
		'as'	=> 'get_cheque'
	]);

Route::post('cheques/set_cheque',[
		'uses'	=> 'ChequesController@set_cheque',
		'as'	=> 'set_cheque'
	]);

Route::post('cheques/anular_cheque',[
		'uses'	=> 'ChequesController@anular_cheque',
		'as'	=> 'anular_cheque'
	]);





Route::post('transferencias/get_parcela_transf',[
		'uses'	=> 'TransferenciasController@get_parcela_transf',
		'as'	=> 'get_parcela_transf'
	]);

Route::post('transferencias/nueva_transferencia',[
		'uses'	=> 'TransferenciasController@nueva_transferencia',
		'as'	=> 'nueva_transferencia'
	]);

Route::post('transferencias/get_transferencia',[
		'uses'	=> 'TransferenciasController@get_transferencia',
		'as'	=> 'get_transferencia'
	]);

Route::post('transferencias/set_transferencia',[
		'uses'	=> 'TransferenciasController@set_transferencia',
		'as'	=> 'set_transferencia'
	]);

Route::post('transferencias/anular_tranferencia',[
		'uses'	=> 'TransferenciasController@anular_tranferencia',
		'as'	=> 'anular_tranferencia'
	]);


});


Route::group(['prefix' => 'simulador','middleware'=>'auth'],function(){
	
	Route::get('simulador',[
		'uses'	=> 'SimuladorController@ver_simulador',
		'as'	=> 'ver_simulador'
	]);

	Route::post('simulador/nueva_simulacion',[
		'uses'	=> 'SimuladorController@nueva_simulacion',
		'as'	=> 'nueva_simulacion'
	]);

	Route::post('simulador/get_simulador',[
		'uses'	=> 'SimuladorController@get_simulador',
		'as'	=> 'get_simulador'
	]);

	Route::post('simulador/set_simulador',[
		'uses'	=> 'SimuladorController@set_simulador',
		'as'	=> 'set_simulador'
	]);

	Route::get('simulador/get_print_simulacion/{sim}',[
		'uses'	=> 'SimuladorController@get_print_simulacion',
		'as'	=> 'get_print_simulacion'
	]);

	Route::post('simulador/anular_simulacion',[
		'uses'	=> 'SimuladorController@anular_simulacion',
		'as'	=> 'anular_simulacion'
	]);



	Route::post('simulador/get_simulador_cuotas',[
		'uses'	=> 'SimuladorController@get_simulador_cuotas',
		'as'	=> 'get_simulador_cuotas'
	]);

	Route::get('simulador/get_print_simulacion_cuotas/{simc}',[
		'uses'	=> 'SimuladorController@get_print_simulacion_cuotas',
		'as'	=> 'get_print_simulacion_cuotas'
	]);

	


	Route::get('simulador_ldm',[
		'uses'	=> 'SimuladorLDMController@ver_simuladorldm',
		'as'	=> 'ver_simuladorldm'
	]);

	Route::post('simulador_ldm/get_listap_sim',[
		'uses'	=> 'SimuladorLDMController@get_listap_sim',
		'as'	=> 'get_listap_sim'
	]);

	Route::post('simulador_ldm/nueva_simulacion_ldm',[
		'uses'	=> 'SimuladorLDMController@nueva_simulacion_ldm',
		'as'	=> 'nueva_simulacion_ldm'
	]);

	Route::get('simulador_ldm/get_print_simulacion_ldm/{sldm}',[
		'uses'	=> 'SimuladorLDMController@get_print_simulacion_ldm',
		'as'	=> 'get_print_simulacion_ldm'
	]);


	Route::post('simulador_ldm/get_simulador_cuotas_ldm',[
		'uses'	=> 'SimuladorLDMController@get_simulador_cuotas_ldm',
		'as'	=> 'get_simulador_cuotas_ldm'
	]);

	Route::get('simulador_ldm/get_print_simulacion_cuotas_ldm/{simcldm}',[
		'uses'	=> 'SimuladorLDMController@get_print_simulacion_cuotas_ldm',
		'as'	=> 'get_print_simulacion_cuotas_ldm'
	]);

	Route::post('simulador_ldm/anular_simulacionldm',[
		'uses'	=> 'SimuladorLDMController@anular_simulacionldm',
		'as'	=> 'anular_simulacionldm'
	]);




Route::get('simulador_cla',[
		'uses'	=> 'SimuladorCLAController@ver_simulador_cla',
		'as'	=> 'ver_simulador_cla'
	]);

Route::post('simulador_cla/nueva_simulacion_cla',[
		'uses'	=> 'SimuladorCLAController@nueva_simulacion_cla',
		'as'	=> 'nueva_simulacion_cla'
	]);

Route::get('simulador_cla/get_print_simulacion_cla/{simcla}',[
		'uses'	=> 'SimuladorCLAController@get_print_simulacion_cla',
		'as'	=> 'get_print_simulacion_cla'
	]);

Route::post('simulador_cla/anular_simulacion_cla',[
		'uses'	=> 'SimuladorCLAController@anular_simulacion_cla',
		'as'	=> 'anular_simulacion_cla'
	]);




Route::post('simulador_cla/get_simulador_cuotas_cla',[
		'uses'	=> 'SimuladorCLAController@get_simulador_cuotas_cla',
		'as'	=> 'get_simulador_cuotas_cla'
	]);

Route::get('simulador_cla/get_print_simulacion_cuotas_cla/{simccla}',[
		'uses'	=> 'SimuladorCLAController@get_print_simulacion_cuotas_cla',
		'as'	=> 'get_print_simulacion_cuotas_cla'
	]);



});


