$(document).ready(documentoListo)
function documentoListo(){
	/**	 OTROS  **/
		$('.chosen').chosen({
	        inherit_select_classes: true,
	        placeholder_text_multiple: 'Seleccione destinatarios',
	        no_results_text: "No hay resultados para:",
	        width: "inherit"//para modal
	    });

	    $('.lg').css('width', '80%');
	    $('.lg').css('font-size', '15px');

	/**	 OTROS  **/
	/**	 PLUGINS  **/

		$(".datatable").DataTable({
	        'aaSorting':[],
	        dom: 'Bfrtip',
	        buttons: [
	            'pageLength',
	            {
	                extend: 'excel',
	                text: '<i class="fas fa-download fa-2x"></i>'
	            }
	            
	        ]
	    });

		$(".datatable_desc").DataTable({
	        "order":[[0, "desc"]],
	        'aaSorting':[]
	        
	    
	    });


	var data_dticket = $(".ver_gestion").DataTable({
        	"order":[[0, "desc"]],
        	'aaSorting':[]
    	});


    	var data_parcelas = $(".ver_parcelas").DataTable({
        	"order":[[0, "desc"]],
        	'aaSorting':[]
    	});

    	var data_cuadro_pagos = $(".ver_cuadro_pagos").DataTable({
        	"order":[[0, "asc"]],
        	'aaSorting':[]
    	});

    	var data_cheque = $(".ver_cheques").DataTable({
        	"order":[[0, "desc"]],
        	'aaSorting':[]
    	});

    	var data_transf = $(".ver_transf").DataTable({
        	"order":[[0, "desc"]],
        	'aaSorting':[]
    	});

    	var data_docx = $(".ver_docx").DataTable({
        	"order":[[0, "desc"]],
        	'aaSorting':[]
    	});

    	var data_cuadro_pagos_sim = $(".ver_cuadro_pagos_sim").DataTable({
        	"order":[[0, "asc"]],
        	'aaSorting':[]
    	});


    	var data_cuadro_pagos_sim_ldm = $(".ver_cuadro_pagos_simldm").DataTable({
        	"order":[[0, "asc"]],
        	'aaSorting':[]
    	});

	   
    	var data_cuadro_pagos_sim_cla = $(".ver_cuadro_pagos_scla").DataTable({
        	"order":[[0, "asc"]],
        	'aaSorting':[]
    	});

	   
	/**	 PLUGINS  **/
	/**------------------------------------------- USUARIO ----------------------------------------------------**/
		$('body').on('click','.check-submenus',function(){
        		marcar_submenu($(this));
    		});

    		function marcar_submenu(boton){
		    if(boton.hasClass('btn-light')){
		        boton.removeClass('btn-light');
		        boton.addClass('btn-dark check-submenus-marcado');
		    }else{
		        boton.removeClass('btn-dark check-submenus-marcado');
		        boton.addClass('btn-light');
		    }
		}



		$('#frm-nuevo-usuario').submit(function(e){
			e.preventDefault();
			crear_set(
				$(this).serialize(),
				$('#btn_nuevo_usuario'),
				'usuarios/nuevo_usuario'
			);		
		});


		$('#frm_edita_usuario').submit(function(e){
			e.preventDefault();
			crear_set(
				$(this).serialize(),
				$('#btn_editar_usuario'),
				'usuarios/set_usuario'
			);		
		});

		$('body').on('click','#btn_edita_usuario',function(){
			$('.check-submenus-marcado').click();
			get_datos(
				$(this),
				'usuarios/get_usuario',
				'Edita_',
				$('#mdl-edita-usuario'),
				'ID_usuario',
				true
				
			);
		})

		$('body').on('click','.btn-ocultar-usuario',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Ocultar usuario?',
					  icon: 'warning',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Ocultar',
					  allowOutsideClick: false,
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza(
								boton,
								'usuarios/delete_usuario',
								'ID_usuario'
							);
						}
					});
		});


		$('body').on('click','.btn-restart-password-usuario',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Restaurar contraseña de usuario?',
					  icon: 'warning',
					   iconColor:'#007bff',
					  showCancelButton: true,
					  confirmButtonColor: '#007bff',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Restaurar',
					  allowOutsideClick: false,
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza(
								boton,
								'usuarios/restart_pasword_usuario',
								'ID_usuario'
							);
						}
					});
		});
/**------------------------------------	 FIN USUARIO ----------------------------------------------------  **/


/**-----------------------------------CLIENTES  --------------------------------------------------------**/	
$('#frm_nuevo_cliente').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_clientes(
				datos,
				$('#btn_nuevo_cliente'),
				'clientes/nuevo_cliente', 
			);
					
		});

$('body').on('click','.btn_edita_cliente',function(){
			get_datos_editar(
				$(this),
				'clientes/get_cliente',
				'EditaC_',
				$('#mdl-edita-cliente'),
				'ID_cliente'
				
			);
		});

$('#frm_edita_cliente').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_clientes(
				datos,
				//new FormData($($(this))[0]),
				$('#btn_editar_cliente'),
				'clientes/set_cliente', 
				
			);		
		});

$('body').on('click','.btn_ocultar_cliente',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar Cliente?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza(
								boton,
								'clientes/anular_cliente',
								'ID_cliente'
							);
						}
					});
		
		});


/**-----------------------------DOCUMENTOS CLIENTES ----------------------------     **/

$('body').on('click','.btn_docx',function(){
				get_datos_docx(
					$(this),
					'doc_clientes/get_cliente_docx',
					'CLD_',
					'ID_cliente',
					data_docx,
					'documentos',
				);
	});


$('#frm_nuevo_documento').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_docx(
				datos,
				$('#btn_new_docx'),
				'doc_clientes/nuevo_documento',
				'agregar', 
			);
					
		});

$('body').on('click','.btn_upd_docx',function(){
			get_datos_editar(
				$(this),
				'doc_clientes/get_documento',
				'EditaCLD_',
				$('#mdl-edita-doc-clientes'),
				'ID_adj_cliente',

			);
		});


$('#frm_edita_documento').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_docx(
				datos,
				$('#btn_edita_docx'),
				'doc_clientes/set_documentos',
				'modificar', 
			);
					
		});

$('body').on('click','.btn_del_docx',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar documento?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza_docx(
								boton,
								'doc_clientes/anular_documentos',
								'ID_adj_cliente'
							);
						}
					});
		
		});







/**-----------------------------FIN DOCUMENTOS CLIENTES ----------------------------     **/



/**----------------------------------- FIN CLIENTES  --------------------------------------------------------**/	
/**-----------------------------------PROYECTOS  --------------------------------------------------------**/	

$('#frm_nuevo_proyecto').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_proyectos(
				datos,
				$('#btn_nuevo_proyecto'),
				'proyectos/nuevo_proyecto', 
			);
					
		});

$('body').on('click','.btn_edita_proyecto',function(){
			get_datos_editar(
				$(this),
				'proyectos/get_proyecto',
				'EditaP_',
				$('#mdl-edita-proyecto'),
				'ID_proyecto'
				
			);
		});


$('#frm_edita_proyecto').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_proyectos(
				datos,
				//new FormData($($(this))[0]),
				$('#btn_editar_proyecto'),
				'proyectos/set_proyecto', 
				
			);		
		});

		$('body').on('click','.btn_ocultar_proyecto',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Deshabilitar Proyecto?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Anular',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza(
								boton,
								'proyectos/anular_proyecto',
								'ID_proyecto'
							);
						}
					});
		
		});

/**-----------------------------------FIN PROYECTOS  --------------------------------------------------------**/	

/**----------------------------------- PARCELAS  --------------------------------------------------------**/	

	$('body').on('click','.btn_parcela',function(){
				get_datos_parcelas(
					$(this),
					'parcelas/get_proyecto_parcela',
					'PAR_',
					'ID_proyecto',
					data_parcelas,
					'parcela',
				);
	});


	$('#frm_nueva_parcela').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_parcelas(
				datos,
				$('#btn_new_parcela'),
				'parcelas/nueva_parcela',
				'agregar', 
			);
					
		});

	$('body').on('click','.btn_upd_parcela',function(){
			get_datos_editar(
				$(this),
				'parcelas/get_parcela',
				'EditaPAR_',
				$('#mdl-edita-parcelas'),
				'ID_parcela',

			);
		});

	$('#frm_edita_parcela').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_parcelas(
				datos,
				$('#btn_edita_parcela'),
				'parcelas/set_parcela',
				'modificar', 
			);
					
		});

	$('body').on('click','.btn_del_parcela',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar Parcela?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza_parcela(
								boton,
								'parcelas/anular_parcela',
								'ID_parcela'
							);
						}
					});
		
		});


	$('body').on('click','.btn_fin_parcela',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Terminar Parcela?',
					  icon: 'info',
					  iconColor:'#28a745',
					  showCancelButton: true,
					  confirmButtonColor: '#28a745',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza(
								boton,
								'parcelas/terminar_parcela',
								'ID_parcela'
							);
						}
					});
		
		});


$('body').on('change','#PAR_PC_tipo_cambio',function(){
        com_moneda($(this));
    });

function com_moneda(opcion){
	    if(opcion.val() == 1){
	    	$('#parcelaenuf').css('display', 'none');
	    	$('#PAR_PC_valor_uf_dia').val();
	    	$('#PAR_PC_fecha_uf').val();
	    	$('#PAR_PC_valor_parcela_uf').val();
	    	
	    }else{
	    	$('#parcelaenuf').removeAttr('style');
	    }
	}


$('body').on('change','#EditaPAR_PC_tipo_cambio',function(){
        com_monedaE($(this));
    });

function com_monedaE(opcion){
	    if(opcion.val() == 1){
	    	$('#parcelaenufE').css('display', 'none');
	    	$('#EditaPAR_PC_valor_uf_dia').val();
	    	$('#EditaPAR_PC_fecha_uf').val();
	    	$('#EditaPAR_PC_valor_parcela_uf').val();
	        
	    }else{
	    	$('#parcelaenufE').removeAttr('style');
	    }
	}


$('body').on('change','#PAR_PC_forma_pago',function(){
        com_forma_pago($(this));
    });

$('body').on('change','#EditaPAR_PC_forma_pago',function(){
        com_forma_pagoE($(this));
    });



function com_forma_pago(opcion){
	    if(opcion.val() == 1){
	    	$('#credirecto').removeAttr('style');
	        $('#contado').css('display', 'none');
	        $('#transmensual').css('display', 'none');
	        	var fvalorPie =	$('#PAR_PC_pie').val(); 
			var fvalorRes = $('#PAR_PC_reserva').val(); 
			var fvalorPar= $('#PAR_PC_valor_parcela').val(); 
			var fresultado = parseInt(fvalorRes) + parseInt(fvalorPie);
		   $('#PAR_PC_cupo_otorgado').val(fvalorPar-fresultado);
		   $('#porcenPieRes').val((fresultado*100)/fvalorPar+'%');
		   $('#cupootor').html(new Intl.NumberFormat('es-CL').format(fvalorPar-fresultado));
	    }else if (opcion.val() == 2) {
	    	$('#contado').removeAttr('style');
	        $('#credirecto').css('display', 'none');
	        $('#transmensual').css('display', 'none');
		        var montoCont = $('#PAR_PC_valor_parcela').val();
		        $('#PAR_PC_monto').val(montoCont);
		        $('#montocontado').html(new Intl.NumberFormat('es-CL').format(montoCont));
	}else if (opcion.val() == 3) {
	    	$('#transmensual').removeAttr('style');
	    	$('#contado').css('display', 'none');
	        $('#credirecto').css('display', 'none');
	        var montotr = $('#PAR_PC_promesa').val();
	        $('#PAR_PC_cupo_otransf').val(montotr);
	        $('#montotr').html(new Intl.NumberFormat('es-CL').format(montotr));
	    }else{
	    	$('#contado').css('display', 'none');
	    	$('#credirecto').css('display', 'none');
	    	$('#transmensual').css('display', 'none');
	    	 $('#PAR_PC_monto').val('');
	    	 $('#PAR_PC_cupo_otorgado').val('');
	    	 $('#PC_cupo_otransf').val('');
	    }
	}




function com_forma_pagoE(opcion){
	    if(opcion.val() == 1){
	    	$('#credirectoE').removeAttr('style');
	        $('#contadoE').css('display', 'none');
	        $('#transmensualE').css('display', 'none');
	         	var fvalorPieE =	$('#EditaPAR_PC_pie').val(); 
			var fvalorResE = $('#EditaPAR_PC_reserva').val(); 
			var fvalorParE= $('#EditaPAR_PC_valor_parcela').val(); 
			var fresultadoE = parseInt(fvalorResE) + parseInt(fvalorPieE);
		   $('#EditaPAR_PC_cupo_otorgado').val(fvalorParE-fresultadoE);
		   $('#EporcenPieRes').val((fresultadoE*100)/fvalorParE+'%');
	    }else if (opcion.val() == 2) {
	    	 $('#contadoE').removeAttr('style');
	        $('#credirectoE').css('display', 'none');
	        $('#transmensualE').css('display', 'none');
	      	var montoContE = $('#EditaPAR_PC_valor_parcela').val();
	        $('#EditaPAR_PC_monto').val(montoContE);

	 }else if (opcion.val() == 3) {
	    	 $('#transmensualE').removeAttr('style');
	        $('#credirectoE').css('display', 'none');
	        $('#contadoE').css('display', 'none');
	      	  var montotrE = $('#EditaPAR_PC_promesa').val();
	        $('#EditaPAR_PC_cupo_otransf').val(montotrE);

	    }else{
	    	$('#contadoE').css('display', 'none');
	    	$('#credirectoE').css('display', 'none');
	    	$('#transmensualE').css('display', 'none');
	    }
	}


	//CREACION

$('body').on('keyup','#PAR_PC_valor_parcela_uf',function(){
        format_valor_uf($(this));
    });

function format_valor_uf(inputvaluf){
		var valorParUF = inputvaluf.val();
	  	$('#valparcelauf').html(new Intl.NumberFormat('es-CL').format(valorParUF));
	}

$('body').on('keyup','#PAR_PC_reserva',function(){
        format_reserva($(this));
    });

function format_reserva(inputReserv){
		var valorReserva = inputReserv.val();
	  	$('#reserv').html(new Intl.NumberFormat('es-CL').format(valorReserva));
	}


$('body').on('keyup','#PAR_PC_pie',function(){
        format_pie($(this));
    });

function format_pie(inputPie){
	var valorPiep = inputPie.val();
	$('#pie').html(new Intl.NumberFormat('es-CL').format(valorPiep));
}


$('body').on('keyup','#PAR_PC_valor_parcela',function(){
        calcular_valor_parcela($(this));
    });

function calcular_valor_parcela(inputV){
		var valorParcela =	inputV.val();
		var reservaP = $('#PAR_PC_reserva').val();
	   $('#PAR_PC_promesa').val(valorParcela-reservaP);
	  
	}

$('body').on('keyup','#PAR_PC_valor_parcela_uf',function(){
        calcular_valor_parcelaUF($(this));
    });

function calcular_valor_parcelaUF(inputUF){
		var valorParUF =	inputUF.val();
		var valorUFhoy = $('#PAR_PC_valor_uf_dia').val();
	   $('#PAR_PC_valor_parcela').val(valorUFhoy*valorParUF);
	  $('#valparcela').html(new Intl.NumberFormat('es-CL').format(valorUFhoy*valorParUF));
	}

$('body').on('keyup','#PAR_PC_reserva',function(){
        calcular_reserva($(this));
    });

function calcular_reserva(inputR){
		var valorReserva = inputR.val();
		var parcela = $('#PAR_PC_valor_parcela').val();
	   $('#PAR_PC_promesa').val(parcela-valorReserva);
	
	}

$('body').on('keyup','#PAR_PC_pie',function(){
        calcular_pie($(this));
    });

function calcular_pie(inputP){
		var valorPie =	inputP.val();
		var valorRes = $('#PAR_PC_reserva').val(); 
		var valorPar= $('#PAR_PC_valor_parcela').val(); 
		var resultado = parseInt(valorRes) + parseInt(valorPie);
	   $('#PAR_PC_cupo_otorgado').val(valorPar-resultado);
	   $('#PAR_PC_promesa').val(valorPar-resultado);
	   $('#porcenPieRes').val((resultado*100)/valorPar+'%');
	   $('#comprav').html(new Intl.NumberFormat('es-CL').format(valorPar-resultado));
	}

//EDICION

	$('body').on('keyup','#EditaPAR_PC_valor_parcela',function(){
        calcular_valor_parcelaE($(this));
    });

function calcular_valor_parcelaE(inputVE){
		var valorParcelaE =	inputVE.val();
		var reservaPE = $('#EditaPAR_PC_reserva').val();
	   $('#EditaPAR_PC_promesa').val(valorParcelaE-reservaPE);
	  
	}

$('body').on('keyup','#EditaPAR_PC_valor_parcela_uf',function(){
        calcular_valor_parcelaUFE($(this));
    });

function calcular_valor_parcelaUFE(inputUFE){
		var valorParUFE =	inputUFE.val();
		var valorUFhoyE = $('#EditaPAR_PC_valor_uf_dia').val();
	   $('#EditaPAR_PC_valor_parcela').val(valorUFhoyE*valorParUFE);
	  
	}



$('body').on('keyup','#EditaPAR_PC_reserva',function(){
        calcular_reservaE($(this));
    });

function calcular_reservaE(inputRE){
		var valorReservaE =	inputRE.val();
		var parcelaE = $('#EditaPAR_PC_valor_parcela').val();
	   $('#EditaPAR_PC_promesa').val(parcelaE-valorReservaE);
	
	}

	$('body').on('keyup','#EditaPAR_PC_pie',function(){
        calcular_pieE($(this));
    });

function calcular_pieE(inputPE){
		var valorPieE =	inputPE.val();
		var valorResE = $('#EditaPAR_PC_reserva').val(); 
		var valorParE= $('#EditaPAR_PC_valor_parcela').val(); 
		var resultadoE = parseInt(valorResE) + parseInt(valorPieE);
	   $('#EditaPAR_PC_cupo_otorgado').val(valorParE-resultadoE);
	   $('#EditaPAR_PC_promesa').val(valorParE-resultadoE);
	    $('#EporcenPieRes').val((resultadoE*100)/valorParE+'%');
	
	}



/**----------------------------------- FIN PARCELAS  --------------------------------------------------------**/	

/**----------------------------------- CUOTAS  --------------------------------------------------------**/	

$('body').on('click','.btn_cuotas',function(){
				get_datos_cuotas(
					$(this),
					'parcelas/get_parcela_cuotas',
					data_cuadro_pagos,
					'c_cuotas',
				);
	});


$('body').on('click','.btn_upd_cuota',function(){
			get_datos_editar(
				$(this),
				'parcelas/get_cuota',
				'EditaCU_',
				$('#mdl-edita-cuadro-pagos'),
				'ID_cuota',

			);
		});

$('#frm_edita_cuadro_pagos').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_cuotas(
				datos,
				$('#btn_edita_cuota'),
				'parcelas/set_cuota',
			);
					
		});

$('body').on('click','.btn_del_cuota',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar Cuota?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza_cuota(
								boton,
								'parcelas/anular_cuota',
								'ID_cuota'
							);
						}
					});
		
		});



/**----------------------------------- FIN CUOTAS  --------------------------------------------------------**/	

/**----------------------------------- CHEQUES  --------------------------------------------------------**/	

$('body').on('click','.btn_cheques',function(){
				get_datos_cheques(
					$(this),
					'cheques/get_parcela_cheque',
					'CHE_',
					'ID_parcela',
					data_cheque,
					'cheque',
				);
	});


$('#frm_nuevo_cheque').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_cheques(
				datos,
				$('#btn_new_cheques'),
				'cheques/nuevo_cheque',
				'agregar', 
			);
					
		});

$('body').on('click','.btn_upd_cheque',function(){
			get_datos_editar(
				$(this),
				'cheques/get_cheque',
				'EditaCHE_',
				$('#mdl-edita-cheques'),
				'ID_cheque',

			);
		});


$('#frm_edita_cheque').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_cheques(
				datos,
				$('#btn_edita_cheques'),
				'cheques/set_cheque',
				'modificar', 
			);
					
		});

$('body').on('click','.btn_del_cheque',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar Cheque?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza_cheque(
								boton,
								'cheques/anular_cheque',
								'ID_cheque'
							);
						}
					});
		
		});



/**----------------------------------- FIN CHEQUES  --------------------------------------------------------**/	

/**-----------------------------------  TRANSFERENCIAS  --------------------------------------------------------**/	

$('body').on('click','.btn_transf',function(){
				get_datos_transf(
					$(this),
					'transferencias/get_parcela_transf',
					'TRF_',
					'ID_parcela',
					data_transf,
					'transf',
				);
	});

	$('#frm_nueva_transf').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_transferencia(
				datos,
				$('#btn_new_transf'),
				'transferencias/nueva_transferencia',
				'agregar', 
			);
					
		});

	$('body').on('click','.btn_upd_transf',function(){
			get_datos_editar(
				$(this),
				'transferencias/get_transferencia',
				'EditaTRF_',
				$('#mdl-edita-transferencias'),
				'ID_transferencia',

			);
		});


	$('#frm_edita_transf').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_transferencia(
				datos,
				$('#btn_edita_transf'),
				'transferencias/set_transferencia',
				'modificar', 
			);
					
		});

	$('body').on('click','.btn_del_transf',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar transferencia?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza_transfer(
								boton,
								'transferencias/anular_tranferencia',
								'ID_transferencia'
							);
						}
					});
		
		});


/**----------------------------------- FIN TRANSFERENCIAS  --------------------------------------------------------**/	

/**----------------------------------- SIMULADOR  --------------------------------------------------------**/	

$('#frm_nueva_simulacion').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_simulacion(
				datos,
				$('#btn_add_simulacion'),
				'simulador/nueva_simulacion', 
			);
					
		});

$('body').on('click','.btn_edita_simulador',function(){
			get_datos_editar(
				$(this),
				'simulador/get_simulador',
				'EditaSM_',
				$('#mdl-edita-simulacion'),
				'ID_simulador'
				
			);
		});


$('#frm_edita_simulacion').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_simulacion(
				datos,
				//new FormData($($(this))[0]),
				$('#btn_upd_simulacion'),
				'simulador/set_simulador', 
				
			);		
		});


	//CREACION

$('body').on('keyup','#S_valor_parcela_uf',function(){
        format_valor_ufSM($(this));
    });

function format_valor_ufSM(inputvalufSM){
		var valorParUFSM = inputvalufSM.val();
	  	$('#valparcelaufSM').html(new Intl.NumberFormat('es-CL').format(valorParUFSM));
	}

$('body').on('keyup','#S_reserva',function(){
        format_reservaSM($(this));
    });

function format_reservaSM(inputReservSM){
		var valorReservaSM = inputReservSM.val();
	  	$('#reservSM').html(new Intl.NumberFormat('es-CL').format(valorReservaSM));
	}


$('body').on('keyup','#S_pie',function(){
        format_pieSM($(this));
    });

function format_pieSM(inputPieSM){
	var valorPiepSM = inputPieSM.val();
	$('#pieSM').html(new Intl.NumberFormat('es-CL').format(valorPiepSM));
}

$('body').on('keyup','#S_valor_parcela_uf',function(){
        calcular_valor_parcelaUFSM2($(this));
    });

function calcular_valor_parcelaUFSM2(inputvalparUF){
		var valorParUFSM =	inputvalparUF.val();
		var valorUFhoySM = $('#S_uf_hoy').val();
	   $('#S_valor_parcela').val(parseInt(valorUFhoySM*valorParUFSM));
	  $('#valparcelaSM').html(new Intl.NumberFormat('es-CL').format(parseInt(valorUFhoySM*valorParUFSM)));
	}


$('body').on('keyup','#S_uf_hoy',function(){
        calcular_valor_parcelaUFSM($(this));
    });

function calcular_valor_parcelaUFSM(inputUF_sm){
		var valorUFhoySM =	inputUF_sm.val();
		var valorParcelaUFSM = $('#S_valor_parcela_uf').val();
	   $('#S_valor_parcela').val(parseInt(valorUFhoySM*valorParcelaUFSM));
	  $('#valparcelaSM').html(new Intl.NumberFormat('es-CL').format(parseInt(valorUFhoySM*valorParcelaUFSM)));
	}

$('body').on('keyup','#S_reserva',function(){
        calcular_reservaSM($(this));
    });

function calcular_reservaSM(inputR_sm){
		var valorReservaSM = inputR_sm.val();
		var parcelaSM = $('#S_valor_parcela').val();
	   $('#S_compraventa').val(parcelaSM-valorReservaSM);
	
	}

$('body').on('keyup','#S_pie',function(){
        calcular_pieSM($(this));
    });

function calcular_pieSM(inputP_sm){
		var valorPieSM =	inputP_sm.val();
		var valorResSM = $('#S_reserva').val(); 
		var valorParSM = $('#S_valor_parcela').val(); 
		var resultadoSM = parseInt(valorResSM) + parseInt(valorPieSM);
	   $('#S_cupo_otorgado').val(valorParSM-resultadoSM);
	   $('#S_compraventa').val(parseInt(valorParSM-resultadoSM));
	   $('#porcenPieResSim').val((resultadoSM*100)/valorParSM+'%');
	   $('#cupootorSM').html(new Intl.NumberFormat('es-CL').format(parseInt(valorParSM-resultadoSM)));
	   $('#compravSM').html(new Intl.NumberFormat('es-CL').format(parseInt(valorParSM-resultadoSM)));
	
	}


$('body').on('click','.btn_eliminar_simulador',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar Simulador?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza(
								boton,
								'simulador/anular_simulacion',
								'ID_simulador'
							);
						}
					});
		
		});




/**----------------------------- CUOTAS SIMULADOR  ---------------------**/	

$('body').on('click','.btn_cuotas_sim',function(){
				get_datos_simcuotas(
					$(this),
					'simulador/get_simulador_cuotas',
					data_cuadro_pagos_sim,
					'sim_cuotas',
				);
	});


/**----------------- FIN CUOTAS SIMULADOR  --------------------------------**/	
/**----------------------------------- FIN SIMULADOR  --------------------------------------------------------**/	


/**----------------------------------- SIMULADOR LDM --------------------------------------------------------**/	

$('#frm_nueva_simulacion_ldm').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_simulacion(
				datos,
				$('#btn_add_simulacion_ldm'),
				'simulador_ldm/nueva_simulacion_ldm', 
			);
					
		});

$('body').on('click','.btn_edita_simulador',function(){
			get_datos_editar(
				$(this),
				'simulador/get_simulador',
				'EditaSM_',
				$('#mdl-edita-simulacion'),
				'ID_simulador'
				
			);
		});


$('#frm_edita_simulacion').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_simulacion(
				datos,
				//new FormData($($(this))[0]),
				$('#btn_upd_simulacion'),
				'simulador/set_simulador', 
				
			);		
		});


$('body').on('change','#ID_parcela_lista',function(){
	       get_parcelaldm_simulacionldm(
		       	$(this).val(),
		       	$('#SLM_valorlistauf'),
		       	$('#SLM_descuento'),
		       	$('#SLM_valorventauf'),
		       	'simulador_ldm/get_listap_sim'
	       	);
	  });


function get_parcelaldm_simulacionldm(select_val,valoruf,desc, valorvuf, ruta){
	    var datos = '_token='+_token+'&ID_parcelas_lista_ldm='+select_val;
	    $.ajax({
	        type: 'POST',
	        url: ruta,
	        data: datos,
	        success: function(retorna) {
	            console.log(retorna)
	             valoruf.val(retorna.PLM_valor_lista);        
	             desc.val(retorna.PLM_descuento);        
	             valorvuf.val(retorna.PLM_valor_venta);        
	        },
	        error:function(retorna){
	            if(retorna.status == 419){
	                location.reload();
	                return
	            }
	            console.log(retorna)
	            $.alert({
	                title:'Información de sistema',
	                content:'Se ha producido un error: <pre>'+retorna.responseJSON.message+'</pre>',
	                type:'red',
	                buttons:{
	                    aceptar:{
	                        btnClass:'btn-red',
	                        action:function(){
	                        }
	                    }
	                }
	           });
	        }
	    });
	}

	$('body').on('keyup','#SLM_valorufhoy',function(){
        	calcular_valor_parcela_simLDM($(this));
    	});

	function calcular_valor_parcela_simLDM(valUF){
		var valorUFhoy =	valUF.val();
		var valorParcelalistaS = $('#SLM_valorlistauf').val();
		var valorParcelaventaS = $('#SLM_valorventauf').val();
	   $('#SLM_valorlistapesos').val(new Intl.NumberFormat('es-CL').format(parseInt(valorUFhoy*valorParcelalistaS)));
	   $('#SLM_valorventapesos').val(new Intl.NumberFormat('es-CL').format(parseInt(valorUFhoy*valorParcelaventaS)));
	  
	}

	$('body').on('change','#SLM_tipo_credito',function(){
        	com_tipo_credito($(this));
    	});

	function com_tipo_credito(opcion){
	    if(opcion.val() == 1){
	        $('#cuotalivpor').css('display', 'none');
	        $('#cuotaliv').css('display', 'none');
	       
	    }else if (opcion.val() == 2) {
	    	$('#cuotalivpor').removeAttr('style');
	    	$('#cuotaliv').removeAttr('style');
	    }else{
	    	$('#cuotalivpor').css('display', 'none');
	    	$('#cuotaliv').css('display', 'none');
	    
	    	
	    }
	}


	$('body').on('keyup','#SLM_pie_solicitado',function(){
        	calcular_pie_solicitado($(this));
    	});

	function calcular_pie_solicitado(pieporc){
		var pie_solic_sm = pieporc.val();
		var valor_parcelaventasm = $('#SLM_valorventauf').val();
		var valorUFhoy = $('#SLM_valorufhoy').val();
		$('#SLM_monto_pie').val(valor_parcelaventasm*(pie_solic_sm/100));
		$('#SLM_monto_pie_pesos').val(new Intl.NumberFormat('es-CL').format(parseInt(valorUFhoy*(valor_parcelaventasm*(pie_solic_sm/100)))));
		$('#SLM_cupo_otorgado').val(valor_parcelaventasm-(valor_parcelaventasm*(pie_solic_sm/100)));
		$('#SLM_cupo_otorgado_pesos').val(new Intl.NumberFormat('es-CL').format(parseInt(valorUFhoy* (valor_parcelaventasm-(valor_parcelaventasm*(pie_solic_sm/100))))));
	  
	}

	$('body').on('keyup','#SLM_cuota_final',function(){
        	calcular_cuota_final($(this));
    	});

	function calcular_cuota_final(cuotaf){
		var cuotafinal = cuotaf.val();
		var valor_parcelaventasm = $('#SLM_valorventauf').val();
		var valor_pie = $('#SLM_monto_pie').val();
		var valorUFhoy = $('#SLM_valorufhoy').val();
		$('#SLM_monto_cuota_final').val(valor_parcelaventasm*(cuotafinal/100));
		$('#SLM_cuota_final_pesos').val(new Intl.NumberFormat('es-CL').format(parseInt(valorUFhoy*(valor_parcelaventasm*(cuotafinal/100)))));
		$('#SLM_cupo_otorgado').val(valor_parcelaventasm-(valor_parcelaventasm*(cuotafinal/100))-valor_pie);
		$('#SLM_cupo_otorgado_pesos').val(new Intl.NumberFormat('es-CL').format(parseInt(valorUFhoy*(valor_parcelaventasm-(valor_parcelaventasm*(cuotafinal/100))-valor_pie))));
	  
	}


	$('body').on('click','.btn_eliminar_simuladorldm',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar Simulador?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza(
								boton,
								'simulador_ldm/anular_simulacionldm',
								'ID_simulador_ldm'
							);
						}
					});
		
		});







/**----------------------------- CUOTAS SIMULADOR  LDM---------------------**/	

$('body').on('click','.btn_cuotas_sldm',function(){
				get_datos_simcuotas_ldm(
					$(this),
					'simulador_ldm/get_simulador_cuotas_ldm',
					data_cuadro_pagos_sim_ldm,
					'sim_cuotas_ldm',
				);
	});





/**----------------- FIN CUOTAS SIMULADOR  LDM--------------------------------**/	
/**----------------------------------- FIN SIMULADOR  LDM--------------------------------------------------------**/	

/**----------------------------------- SIMULADOR  CLA--------------------------------------------------------**/	

$('#frm_nueva_simulacion_cla').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_simulacion(
				datos,
				$('#btn_add_simulacion_cla'),
				'simulador_cla/nueva_simulacion_cla', 
			);
					
		});

//CREACION

$('body').on('keyup','#SCLA_valor_parcela_uf',function(){
        format_valor_ufSMcla($(this));
    });

function format_valor_ufSMcla(inputvalufSMcla){
		var valorParUFSMcla = inputvalufSMcla.val();
	  	$('#valparcelaufSMcla').html(new Intl.NumberFormat('es-CL').format(valorParUFSMcla));
	}

$('body').on('keyup','#SCLA_reserva',function(){
        format_reservaSMcla($(this));
    });

function format_reservaSMcla(inputReservSMcla){
		var valorReservaSMcla = inputReservSMcla.val();
	  	$('#reservSMcla').html(new Intl.NumberFormat('es-CL').format(valorReservaSMcla));
	}


$('body').on('keyup','#SCLA_pie',function(){
        format_pieSMcla($(this));
    });

function format_pieSMcla(inputPieSMcla){
	var valorPiepSMcla = inputPieSMcla.val();
	$('#pieSMcla').html(new Intl.NumberFormat('es-CL').format(valorPiepSMcla));
}

$('body').on('keyup','#SCLA_valor_parcela_uf',function(){
        calcular_valor_parcelaUFSM2cla($(this));
    });

function calcular_valor_parcelaUFSM2cla(inputvalparUFcla){
		var valorParUFSMcla =	inputvalparUFcla.val();
		var valorUFhoySMcla = $('#SCLA_uf_hoy').val();
	   $('#SCLA_valor_parcela').val(parseInt(valorUFhoySMcla*valorParUFSMcla));
	  $('#valparcelaSMcla').html(new Intl.NumberFormat('es-CL').format(parseInt(valorUFhoySMcla*valorParUFSMcla)));
	}


$('body').on('keyup','#SCLA_uf_hoy',function(){
        calcular_valor_parcelaUFSMcla($(this));
    });

function calcular_valor_parcelaUFSMcla(inputUF_smcla){
		var valorUFhoySMcla =	inputUF_smcla.val();
		var valorParcelaUFSMcla = $('#SCLA_valor_parcela_uf').val();
	   $('#SCLA_valor_parcela').val(parseInt(valorUFhoySMcla*valorParcelaUFSMcla));
	  $('#valparcelaSMcla').html(new Intl.NumberFormat('es-CL').format(parseInt(valorUFhoySMcla*valorParcelaUFSMcla)));
	}

$('body').on('keyup','#SCLA_reserva',function(){
        calcular_reservaSMcla($(this));
    });

function calcular_reservaSMcla(inputR_smcla){
		var valorReservaSMcla = inputR_smcla.val();
		var parcelaSMcla = $('#SCLA_valor_parcela').val();
	   $('#SCLA_compraventa').val(parcelaSMcla-valorReservaSMcla);
	
	}

$('body').on('keyup','#SCLA_pie',function(){
        calcular_pieSMcla($(this));
    });

function calcular_pieSMcla(inputP_smcla){
		var valorPieSMcla =	inputP_smcla.val();
		var valorResSMcla = $('#SCLA_reserva').val(); 
		var valorParSMcla = $('#SCLA_valor_parcela').val(); 
		var resultadoSMcla = parseInt(valorResSMcla) + parseInt(valorPieSMcla);
	   $('#SCLA_cupo_otorgado').val(valorParSMcla-resultadoSMcla);
	   $('#SCLA_compraventa').val(parseInt(valorParSMcla-resultadoSMcla));
	   $('#porcenPieResSimcla').val((resultadoSMcla*100)/valorParSMcla+'%');
	   $('#cupootorSMcla').html(new Intl.NumberFormat('es-CL').format(parseInt(valorParSMcla-resultadoSMcla)));
	   $('#compravSMcla').html(new Intl.NumberFormat('es-CL').format(parseInt(valorParSMcla-resultadoSMcla)));
	
	}

	$('body').on('click','.btn_eliminar_simuladorcla',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar Simulaci&oacute;n?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza(
								boton,
								'simulador_cla/anular_simulacion_cla',
								'ID_simulador_cla'
							);
						}
					});
		
		});

/**----------------------------------- CUOTAS SIMULADOR CLA --------------------------------------------------------**/	

$('body').on('click','.btn_cuotas_scla',function(){
				get_datos_simcuotas_cla(
					$(this),
					'simulador_cla/get_simulador_cuotas_cla',
					data_cuadro_pagos_sim_cla,
					'sim_cuotas_cla',
				);
	});


/**-----------------------------------FIN CUOTAS SIMULADOR CLA --------------------------------------------------------**/	

/**----------------------------------- FIN SIMULADOR  CLA--------------------------------------------------------**/	




/**----------------------------------- TASA ANUAL  --------------------------------------------------------**/	


$('#frm_nueva_tasa_anual').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_tasa_anual(
				datos,
				$('#btn_add_tasa_anual'),
				'tasa_anual/nueva_tasa_anual', 
			);
					
		});

$('body').on('click','.btn_edita_tasa_anual',function(){
			get_datos_editar(
				$(this),
				'tasa_anual/get_tasa_anual',
				'EditaTA_',
				$('#mdl-edita-tasa-anual'),
				'ID_tasa_anual'
				
			);
		});


$('#frm_edita_tasa_anual').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_tasa_anual(
				datos,
				//new FormData($($(this))[0]),
				$('#btn_upd_tasa_anual'),
				'tasa_anual/set_tasa_anual', 
				
			);		
		});


$('body').on('click','.btn_ocultar_tasa_anual',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar Tasa Anual?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza(
								boton,
								'tasa_anual/anular_tasa_anual',
								'ID_tasa_anual'
							);
						}
					});
		
		});



/**----------------------------------- FIN TASA ANUAL  --------------------------------------------------------**/	

/**----------------------------------- PARCELAS LDM  --------------------------------------------------------**/	

$('#frm_nueva_parcela_ldm').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_parcelas_ldm(
				datos,
				$('#btn_add_parcela_ldm'),
				'parcelas_ldm/nueva_parcela_ldm',
			);
					
		});


$('body').on('keyup','#PLM_descuento',function(){
        valor_venta_parcela($(this));
    });

function valor_venta_parcela(inputdesc){
		var descuentoparcela =	inputdesc.val();
		var valorlistaparcela = $('#PLM_valor_lista').val();
	   $('#PLM_valor_venta').val(valorlistaparcela-(valorlistaparcela*(descuentoparcela/100)));
	  
	}

$('body').on('click','.btn_editar_parcela_ldm',function(){
			get_datos_editar(
				$(this),
				'parcelas_ldm/get_parcela_ldm',
				'EditaPLDM_',
				$('#mdl-edita-parcela-ldm'),
				'ID_parcelas_lista_ldm'
				
			);
		});

$('body').on('keyup','#EditaPLDM_PLM_descuento',function(){
        valor_venta_parcelaE($(this));
    });

function valor_venta_parcelaE(inputdescE){
		var descuentoparcelaE =	inputdescE.val();
		var valorlistaparcelaE = $('#EditaPLDM_PLM_valor_lista').val();
	   $('#EditaPLDM_PLM_valor_venta').val(valorlistaparcelaE-(valorlistaparcelaE*(descuentoparcelaE/100)));
	  
	}

$('#frm_edita_parcela_ldm').submit(function(e){
			e.preventDefault();
			var datos = new FormData(this);
			crear_set_parcelas_ldm(
				datos,
				$('#btn_edita_parcela_ldm'),
				'parcelas_ldm/set_parcela_ldm' ,
			);
					
		});

$('body').on('click','.btn_ocultar_parcela_ldm',function(){
			let boton = $(this)
			Swal.fire({
					  title: '¿Eliminar Parcela?',
					  icon: 'info',
					  iconColor:'#d33',
					  showCancelButton: true,
					  confirmButtonColor: '#d33',
					  cancelButtonColor: '#848484',
					  confirmButtonText: 'Si',
					 }).then((result) => {
			            if (result.isConfirmed) {
							delete_finaliza(
								boton,
								'parcelas_ldm/anular_parcela_ldm',
								'ID_parcelas_lista_ldm'
							);
						}
					});
		
		});

/**----------------------------------- FIN PARCELAS LDM  --------------------------------------------------------**/	





$('body').on('click','.icon_add-row-lineas',function(){
        add_rows_table_videos($('#tbl-vservicios tbody tr:first'), $('#tbl-vservicios tbody'));
    })

function add_rows_table_videos(tabla_tbody_tr, tabla_tbody){
    var tr = tabla_tbody_tr.clone();
    tr.find('input').each(function(){
        $(this).val('');
    });

    tr.find('input').each(function(){
        $(this).val('');
    });

    tr.find('input').each(function(){
        $(this).val('');
    });

    tabla_tbody.append(tr);

}

	$('body').on('click','.icon_sub-row-lineas', function(){
        if($(this).parents('tbody')[0].rows.length > 1){
            $(this).parents('tr').remove();
        }        
   });


    




    
	}
	//AKY
var _token = $('meta[name="csrf-token"]').attr('content');


/*-------------------------------ELIMINAR Y ACTIVAR-----------------------------------------------------------*/
		
function delete_finaliza(boton,ruta,id_modelo){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value');
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	plugin_alerta_success(retorna.titulo,retorna.msj,retorna.color,'aceptar')
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

function delete_finaliza_parcela(boton,ruta,id_modelo){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value');
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	boton.parents('tr').remove();
           	Swal.fire(
				  '¡ Parcela eliminada!',
				  'Se ha eliminado la parcela!',
				  'success'
				)
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}


function delete_finaliza_cheque(boton,ruta,id_modelo){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value');
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	boton.parents('tr').remove();
           	Swal.fire(
				  '¡ Cheque eliminado!',
				  'Se ha eliminado el cheque!',
				  'success'
				)
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}


function delete_finaliza_docx(boton,ruta,id_modelo){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value');
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	boton.parents('tr').remove();
           	Swal.fire(
				  '¡Documento eliminado!',
				  'Se ha eliminado el documento!',
				  'success'
				)
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

function delete_finaliza_cuota(boton,ruta,id_modelo){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value');
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	boton.parents('tr').remove();
           	Swal.fire(
				  '¡Cuota eliminada!',
				  'Se ha eliminado la cuota!',
				  'success'
				)
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

function delete_finaliza_transfer(boton,ruta,id_modelo){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value');
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	boton.parents('tr').remove();
           	Swal.fire(
				  '¡Transferencia eliminada!',
				  'Se ha eliminado la transferencia!',
				  'success'
				)
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}




/*------------------------------------------------------------------------------------------------------*/


/*-------------------------------OBTENER DATOS-----------------------------------------------------------*/

function get_datos(boton,ruta,alias,modal,id_modelo, usuario = false, lbl_encabezado = null){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value');
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	if(lbl_encabezado != null){
           		$('#lbl_' + lbl_encabezado).html(retorna[lbl_encabezado]);
           	}
           	$.each(retorna,function(campo, valor) {
           		$('#'+alias+campo).val(valor);
           	});

           	$.each(retorna.submenus, function(indice_arr, modelo){
           		$('#lbl-btn-Edita_submenu'+modelo.ID_submenu).click();
           	});
    
           	$('select').trigger("chosen:updated");
           	modal.modal('show');
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

$('body').on('click','.btn_flujo_proyecto',function(){
        get_flu_proyecto($(this), 'proyectos/get_flujo_proyecto');
    })

function get_flu_proyecto(boton, ruta){
    var datos = '_token='+_token+'&ID_proyecto='+boton.attr('value');
    boton.attr('disabled',true);
    btn_text = boton.html();
    $.ajax({
        type:'POST',
        url: ruta,
        data: datos,
        success: function(retorna){
            console.log(retorna);
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna, function(indice, valor) {
                $('#'+indice).html(valor);

            });
            $('.btn_imprimir').attr('href', 'proyectos/get_print_flujo_proyecto/'+retorna.ID_proyecto);
            
           $('#mdl-flujo-proyecto').modal('show');
        },
        error: function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            plugin_alerta_error(retorna)
        }
    });
}


function get_datos_parcelas(boton,ruta,alias,id_modelo,tabla,identificador){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value')+'&identificador='+identificador;
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	$.each(retorna,function(campo, valor) {
           		$('#'+alias+campo).val(valor);
           	});
           	$('select').trigger("chosen:updated");
			
           	show_table_parcelas(retorna,tabla,identificador)
           	$('#PAR_ID_proyecto').val(retorna.IDP);
           	$('.nomTax').html(retorna.nomP);

           	if (retorna.ulogin == 3) {
           		$('#add_par').css('display' , 'none');
           	}else{
           		$('#add_par').removeAttr('style');
           	}

           	if (retorna.mastplan != null) {
           		$('.masterplan').html('<img width="50%" src="../img/masterp/'+retorna.mastplan+'">');
       		}else{
        		$('.masterplan').html('No tiene');
        	}

        	
           	
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

	function show_table_parcelas(retorna,tabla,tipo){
	    tabla.clear().draw();
	    switch(tipo){
	        case 'parcela':
	            $.each(retorna.datos.proy_parcela,function(indice,valor){
	                tabla.row.add([
	                    valor.ID_parcela,
	                    valor.PC_num_parcela,
	                    ['<p style="text-align: center;">'+valor.PC_nombre+'</p>'],
	                    ['<p style="text-align: center;">'+valor.PC_admin_ant+'</p>'],
	                    valor.cliente.CL_nombre,
	                    [((valor.forma_pago == 2) ? '<p style="text-align: center;"> Sin cuotas </p>' : 
	                    	(valor.forma_pago == 3) ? 'Transferencias Mensuales' : '<p style="text-align: center;"><button type="button"  class="btn btn-link font-weight-bold btn_cuotas"  value="'+valor.ID_parcela+'">'+valor.PC_cant_cheques+'</button></p>')],
	                    [((valor.forma_pago == 2) ? '<p style="text-align: center;"> Al Contado </p>' : 
	                    	(valor.forma_pago == 3) ? '<p style="text-align: center;">'+valor.cantidad_transferencias+'/'+valor.PC_cant_transf+'</p>' :  '<p style="text-align: center;">'+valor.cantidad_cheques+'/'+valor.PC_cant_cheques+'</p>'
	                    +'<button type="button" class="btn btn-success btn-sm btn_cheques"  value="'+valor.ID_parcela+'"><i class="fas fa-eye"></i> Cheques</button>')
	                    +((valor.forma_pago == 3) ?'<button type="button" class="btn btn-secondary btn-sm btn_transf"  value="'+valor.ID_parcela+'">Transferencias</button>' : '<p style="text-align: center;">  </p>')],
	                    ['<p><strong>Creación:</strong><br> '+valor.PC_fecha_creacion+'</p>'
				+'<p><strong>Actualización:</strong><br> '+valor.PC_fecha_actualizacion+'</p>'],
			    ['<p style="text-align: center;"><button type="button" class="'+valor.com_pago.CP_color+'">'+valor.com_pago.CP_nombre +'</button></p>'],
			    ['<p style="text-align: center;">'+valor.estado.E_nombre+'</p>'],
	                    ['<div class="btn-group-vertical">'
	                    +((valor.userlog == 3 ) ? ' ' : '<button type="button" class="btn btn-warning btn-sm btn_upd_parcela" id="udp_pa'+valor.ID_parcela+'" value="'+valor.ID_parcela+'"><i class="fas fa-pencil-alt"></i></button>') 
	                    +((valor.userlog == 3 ) ? ' ' : '<button type="button" class="btn btn-danger btn-sm btn_del_parcela" id="udp_pa'+valor.ID_parcela+'" value="'+valor.ID_parcela+'"><i class="fas fa-times"></i></button>' )
	                    +((valor.userlog == 3 ) ? ' ' : '<button type="button" class="btn btn-success btn-sm btn_fin_parcela" id="udp_pa'+valor.ID_parcela+'" value="'+valor.ID_parcela+'"><i class="fas fa-check "></i></button>' )
	                    +'<button type="button" class="btn btn-primary btn-sm btn_res_parcela" id="udp_pa'+valor.ID_parcela+'" value="'+valor.ID_parcela+'"><i class="fas fa-eye"></i></button>'      
	                    +'</div>']   

	                ]).draw(false)
	                
	            });
	          	$('#mdl-parcelas').modal('show');
	          break;

	          default:
	        	break;
	        }
	}

	

	$('body').on('click','.btn_res_parcela',function(){
        get_res_parcela($(this), 'parcelas/get_resumen_parcela');
    })

function get_res_parcela(boton, ruta){
    var datos = '_token='+_token+'&ID_parcela='+boton.attr('value');
    boton.attr('disabled',true);
    btn_text = boton.html();
    $.ajax({
        type:'POST',
        url: ruta,
        data: datos,
        success: function(retorna){
            console.log(retorna);
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna, function(indice, valor) {
                $('#'+indice).html(valor);
            });
            $('.btn_imprimir_res').attr('href', 'parcelas/get_print_resumen_parcela/'+retorna.ID_parcela);

            if (retorna.PC_forma_pago == 1) {
            	$('#res_pie').removeAttr('style');
            	$('#res_fechaI').removeAttr('style');
            	$('#res_cupo').removeAttr('style');
            	$('#res_tasanual').removeAttr('style');
            	$('#res_cantcheques').removeAttr('style');
            	$('#res_fechaUC').removeAttr('style');
            	$('#res_valorcuota').removeAttr('style');
            	$('#res_cuotaspagadas').removeAttr('style');
            	$('#res_cuotasatrasadas').removeAttr('style');
            	$('#res_montoatrasado').removeAttr('style');
            	$('#res_montopagado').removeAttr('style');
            	$('#res_saldoporpagar').removeAttr('style');
            	
	        $('#res_contado').css('display', 'none');
	        $('#res_fechaiT').css('display', 'none');
	        $('#res_cupoT').css('display', 'none');
	        $('#res_ntransfer').css('display', 'none');
	        $('#res_cuotaT').css('display', 'none');
	        $('#res_UcuotaT').css('display', 'none');
	        $('#res_cuotaspagadasT').css('display', 'none');
            	$('#res_montopagadoT').css('display', 'none');
            	$('#res_saldoporpagarT').css('display', 'none');   
            	$('#res_tasanualT').css('display', 'none');   
            	$('#res_cuotasatrasadasT').css('display', 'none');   
            	$('#res_montoatrasadoT').css('display', 'none');   

            }else if(retorna.PC_forma_pago == 2){
            	$('#res_contado').removeAttr('style');

            	$('#res_fechaI').css('display', 'none');
            	$('#res_pie').css('display', 'none');
            	$('#res_cupo').css('display', 'none');
            	$('#res_tasanual').css('display', 'none');
            	$('#res_cantcheques').css('display', 'none');
            	$('#res_fechaUC').css('display', 'none');
            	$('#res_valorcuota').css('display', 'none');
            	$('#res_cuotaspagadas').css('display', 'none');
            	$('#res_cuotasatrasadas').css('display', 'none');
            	$('#res_montopagado').css('display', 'none');
            	$('#res_montoatrasado').css('display', 'none');
            	$('#res_saldoporpagar').css('display', 'none'); 
            	$('#res_fechaiT').css('display', 'none');
	        $('#res_cupoT').css('display', 'none');
	        $('#res_ntransfer').css('display', 'none');
	        $('#res_cuotaT').css('display', 'none');    
	        $('#res_UcuotaT').css('display', 'none');  
	        $('#res_cuotaspagadasT').css('display', 'none');
            	$('#res_montopagadoT').css('display', 'none');
            	$('#res_saldoporpagarT').css('display', 'none');   
            	$('#res_tasanualT').css('display', 'none');   
            	$('#res_cuotasatrasadasT').css('display', 'none');   
            	$('#res_montoatrasadoT').css('display', 'none');   

            }else{
            	$('#res_fechaiT').removeAttr('style');
	        $('#res_cupoT').removeAttr('style');
	        $('#res_ntransfer').removeAttr('style');
	        $('#res_cuotaT').removeAttr('style');
	        $('#res_UcuotaT').removeAttr('style');
	        $('#res_cuotaspagadasT').removeAttr('style');
	        $('#res_montopagadoT').removeAttr('style');
	        $('#res_saldoporpagarT').removeAttr('style');
	        $('#res_tasanualT').removeAttr('style');
	        $('#res_cuotasatrasadasT').removeAttr('style');
	        $('#res_montoatrasadoT').removeAttr('style');
	        

            	$('#res_contado').css('display', 'none');
            	$('#res_fechaI').css('display', 'none');
            	$('#res_pie').css('display', 'none');
            	$('#res_cupo').css('display', 'none');
            	$('#res_tasanual').css('display', 'none');
            	$('#res_cantcheques').css('display', 'none');
            	$('#res_fechaUC').css('display', 'none');
            	$('#res_valorcuota').css('display', 'none');
            	$('#res_cuotaspagadas').css('display', 'none');
            	$('#res_cuotasatrasadas').css('display', 'none');
            	$('#res_montopagado').css('display', 'none');
            	$('#res_montoatrasado').css('display', 'none');
            	$('#res_saldoporpagar').css('display', 'none');     	
            }

           $('#mdl-resumen-parcelas').modal('show');
           
        },
        error: function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            plugin_alerta_error(retorna)
        }
    });
}


function get_datos_cuotas(boton,ruta,tabla,identificador){
	var datos = '_token='+_token+'&ID_parcela='+boton.attr('value')+'&identificador='+identificador;
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {

        	$('.btn_imprimir_cuadro').attr('href', 'parcelas/get_print_cuadro_pagos/'+retorna.IDpar);
           	console.log(retorna);
           	show_table_cuotas(retorna,tabla,identificador); 
           	$('#valorcuentaactual').html(retorna.valorcuotap);
           	$('#numcuentaactual').html(retorna.numcuota);
           	$('.btn_pago_masivo').val(retorna.IDpar);
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

	function show_table_cuotas(retorna,tabla,tipo){
	    tabla.clear().draw();
	    switch(tipo){
	        case 'c_cuotas':
	            $.each(retorna.datos.parcela_cuotas,function(indice,valor){
	                tabla.row.add([
	                   valor.ID_cuota,
	                   ['<p style="text-align: center;">Cuota '+valor.CT_nro_cuota+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CT_fecha_vencimiento+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CT_valor_cuota+'</p>'],
	                   ['<p style="text-align: center;">'+valor.estado_cuota.ECT_nombre+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CT_fecha_pago+'</p>'],
	                   ['<div class="btn-group">'
	                    +((valor.userlog == 3 ) ? ' ' : '<button type="button" class="btn btn-warning btn-sm btn_upd_cuota" id="upd_cuo'+valor.ID_cuota+'" value="'+valor.ID_cuota+'"><i class="fas fa-pencil-alt"></i></button>') 
	                    +((valor.userlog == 3 ) ? ' ' : '<button type="button" class="btn btn-danger btn-sm btn_del_cuota" id="upd_cuo'+valor.ID_cuota+'" value="'+valor.ID_cuota+'"><i class="fas fa-times"></i></button>' )
	                    +'</div>'] 
	                  
	                ]).draw(false)
	     
	            });
	          	$('#mdl-cuadro-pagos').modal('show');
	        break;

	          default:
	        break;
	        }
	}





function get_datos_cheques(boton,ruta,alias,id_modelo,tabla,identificador){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value')+'&identificador='+identificador;
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	$.each(retorna,function(campo, valor) {
           		$('#'+alias+campo).val(valor);
           	});
           	
           	$('select').trigger("chosen:updated");
           	show_table_cheques(retorna,tabla,identificador)
           	$('#CHE_ID_parcela').val(retorna.IDPa);
           	$('#CHE_CHQ_monto').val(retorna.valorC);
           	$('.nomPar').html(retorna.nomPa);
           	$('.nomcli').html(retorna.nom_cli);


           	if (retorna.ulogin == 3) {
           		$('#add_chq').css('display' , 'none');
           	}else{
           		$('#add_chq').removeAttr('style');
           		
           	}


           	
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

	function show_table_cheques(retorna,tabla,tipo){
	    tabla.clear().draw();
	    switch(tipo){
	        case 'cheque':
	            $.each(retorna.datos.parcela_cheque,function(indice,valor){
	                tabla.row.add([
	                    valor.ID_cheque,
	                    ['<p style="text-align: center;">'+valor.CHQ_titular+'</p>'],
	                    ['<p style="text-align: center;">$'+valor.CHQ_monto+'</p>'],
	                    ['<p><strong>Banco:</strong><br> '+valor.CHQ_banco+'</p>'
						+'<p><strong>Nro Cuenta:</strong><br> '+valor.CHQ_nro_cuenta+'</p>'
						+'<p><strong>Nro Serie:</strong><br> '+valor.CHQ_nro_serie+'</p>'],
	                    ['<p style="text-align: center;">'+valor.CHQ_fecha_deposito+'</p><br><p style="text-align: center;">Cuota '+valor.cuota.CT_nro_cuota+'</p>'],
	                    ['<p style="text-align: center;">'+((valor.CHQ_comprobante_dep == null ) ? '-' : valor.CHQ_comprobante_dep)+'</p>'],
	                    [''+((valor.CHQ_adjunto == null ) ? '-' : '<a href="../storage/cheques_adj/'+valor.CHQ_adjunto+'" target="_blank">CHEQUE</a>')+'<br>'
	                    +((valor.CHQ_adjunto_comp == null ) ? '-' : '<a href="../storage/cheques_adj/comprobantes/'+valor.CHQ_adjunto_comp+'" target="_blank">COMPROBANTE</a>')+''],
	                    ['<p style="text-align: center;" class="'+valor.estado_chq.ECH_color+'">'+valor.estado_chq.ECH_nombre+'</p>'],
	                    ['<p><strong>Creación:</strong><br> '+valor.CHQ_fecha_creacion+'</p>'
						+'<p><strong>Actualización:</strong><br> '+valor.CHQ_fecha_actualizacion+'</p>'],
	                    ['<div class="btn-group">'
	                    +((valor.userlog == 3 ) ? ' ' :  '<button type="button" class="btn btn-warning btn-sm btn_upd_cheque" id="udp_chq'+valor.ID_cheque+'" value="'+valor.ID_cheque+'"><i class="fas fa-pencil-alt"></i></button>')
	                    +((valor.userlog == 3 ) ? ' ' : '<button type="button" class="btn btn-danger btn-sm btn_del_cheque" id="udp_chq'+valor.ID_cheque+'" value="'+valor.ID_cheque+'"><i class="fas fa-times"></i></button>')     
	                    +'</div>']            
	                    
	                ]).draw(false)
	                
	            });
	          	$('#mdl-cheques').modal('show');
	          break;

	          default:
	        	break;
	        }
	}


function get_datos_transf(boton,ruta,alias,id_modelo,tabla,identificador){
    var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value')+'&identificador='+identificador;
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	$.each(retorna,function(campo, valor) {
           		$('#'+alias+campo).val(valor);
           	});
           	
           	$('select').trigger("chosen:updated");
           	show_table_transf(retorna,tabla,identificador)
           	$('#TRF_ID_parcela').val(retorna.IDPatr);
           	$('#TRF_TR_monto').val(retorna.valortr);
           	$('.nomPartr').html(retorna.nomPatr);
           	$('.nomcli').html(retorna.nom_clitr);


           	if (retorna.ulogin == 3) {
           		$('#add_transf').css('display' , 'none');
           	}else{
           		$('#add_transf').removeAttr('style');
           		
           	}


           	
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

	function show_table_transf(retorna,tabla,tipo){
	    tabla.clear().draw();
	    switch(tipo){
	        case 'transf':
	            $.each(retorna.datos.parcela_transferencias,function(indice,valor){
	                tabla.row.add([
	                    valor.ID_transferencia,
	                    ['<p style="text-align: center;">'+valor.TR_titular+'</p>'],
	                    ['<p style="text-align: center;">$'+valor.TR_monto+'</p>'],
	                    ['<p style="text-align: center;">'+valor.TR_banco+'</p>'],
			    ['<p style="text-align: center;">'+valor.TR_cuenta+'</p>'],
			    ['<p style="text-align: center;">'+valor.TR_numero+'</p>'],
	                    ['<p style="text-align: center;">'+valor.TR_fecha_deposito+'</p>'],
	                    [''+((valor.TR_comprobante == null ) ? '-' : '<a href="../storage/transf_adj/'+valor.TR_comprobante+'" target="_blank">COMPROBANTE</a>')+''],
	                    ['<p><strong>Creación:</strong><br> '+valor.TR_fecha_creacion+'</p>'
						+'<p><strong>Actualización:</strong><br> '+valor.TR_fecha_actualizacion+'</p>'
						+'<p style="text-align: center;" class="'+valor.estadotransfer.ETF_color+'">'+valor.estadotransfer.ETF_nombre+'</p>'],
	                    ['<div class="btn-group">'
	                    +((valor.userlog == 3 ) ? ' ' :  '<button type="button" class="btn btn-warning btn-sm btn_upd_transf" id="upd_trf'+valor.ID_transferencia+'" value="'+valor.ID_transferencia+'"><i class="fas fa-pencil-alt"></i></button>')
	                    +((valor.userlog == 3 ) ? ' ' : '<button type="button" class="btn btn-danger btn-sm btn_del_transf" id="upd_trf'+valor.ID_transferencia+'" value="'+valor.ID_transferencia+'"><i class="fas fa-times"></i></button>')     
	                    +'</div>']            
	                    
	                ]).draw(false)
	                
	            });
	          	$('#mdl-transferencias').modal('show');
	          break;

	          default:
	        	break;
	        }
	}











function get_datos_docx(boton,ruta,alias,id_modelo,tabla,identificador){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value')+'&identificador='+identificador;
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	$.each(retorna,function(campo, valor) {
           		$('#'+alias+campo).val(valor);
           	});
           	$('select').trigger("chosen:updated");
           	show_table_docx(retorna,tabla,identificador)
           	$('#CLD_ID_cliente').val(retorna.IDCL);
           	$('.nomCL').html(retorna.nomCL);
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

	function show_table_docx(retorna,tabla,tipo){
	    tabla.clear().draw();
	    switch(tipo){
	        case 'documentos':
	            $.each(retorna.datos.cliente_docx,function(indice,valor){
	                tabla.row.add([
	                    ['<p style="text-align: center;">'+valor.ID_adj_cliente+'</p>'] ,
	                    ['<p style="text-align: center;">'+valor.ACL_nombre+'</p>'],
	                    ['<p style="text-align: center;">'+((valor.ACL_ruta == null ) ? '-' : '<a href="../storage/clientes_adj/'+valor.ACL_ruta+'" target="_blank">ADJUNTO</a>')+'</p>'],
	                    ['<p style="text-align: center;">'+valor.ACL_fecha_creacion+'</p>'],
	                    ['<p style="text-align: center;">'+valor.ACL_fecha_actualizacion+'</p>'],
	                    ['<p style="text-align: center;">'+valor.estado.E_nombre+'</p>'],
	                    ['<div class="btn-group">'
	                    +'<button type="button" class="btn btn-warning btn-sm btn_upd_docx" id="udp_docx'+valor.ID_adj_cliente+'" value="'+valor.ID_adj_cliente+'"><i class="fas fa-pencil-alt"></i></button>'
	                    +'<button type="button" class="btn btn-danger btn-sm btn_del_docx" id="udp_docx'+valor.ID_adj_cliente+'" value="'+valor.ID_adj_cliente+'"><i class="fas fa-times"></i></button>'      
	                    +'</div>']            
	                    
	                ]).draw(false)
	                
	            });
	          	$('#mdl-doc-clientes').modal('show');
	          break;

	          default:
	        	break;
	        }
	}



function get_datos_simcuotas(boton,ruta,tabla,identificador){
	var datos = '_token='+_token+'&ID_simulador='+boton.attr('value')+'&identificador='+identificador;
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
        	$('#montoprestamosim').html(retorna.prestamo);
        	$('#numcuotassim').html(retorna.numcuotasim);
        	$('#valorcuotasim').html(retorna.valorcuotasim);
        	$('#tasaanualsim').html(retorna.tasaanual);
        	$('#tasamensualsim').html(retorna.tasamensual);
        	$('#totalsim').html(retorna.totalsim);
        	$('#costosim').html(retorna.costosim);
        	$('#capitalsim').html(retorna.prestamo);
        	$('#interessim').html(retorna.interessim);
        	$('#saldosim').html(retorna.saldosim);
        	$('.btn_imprimir_cuadro_sim').attr('href', 'simulador/get_print_simulacion_cuotas/'+retorna.IDsim);
           	console.log(retorna);
           	show_table_simcuotas(retorna,tabla,identificador); 

        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

	function show_table_simcuotas(retorna,tabla,tipo){
	    tabla.clear().draw();
	    switch(tipo){
	        case 'sim_cuotas':
	            $.each(retorna.datos.simulador_cuotas,function(indice,valor){
	                tabla.row.add([
	                   valor.ID_cuota_sim,
	                   ['<p style="text-align: center;">Cuota '+valor.CTS_nro_cuota+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CTS_fecha_vencimiento+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CTS_valor_cuota+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CTS_capital+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CTS_interes+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CTS_saldo+'</p>']

	             
	                  
	                ]).draw(false)
	     
	            });
	          	$('#mdl-cuadro-pagos-simulacion').modal('show');
	        break;

	          default:
	        break;
	        }
	}



function get_datos_simcuotas_ldm(boton,ruta,tabla,identificador){
	var datos = '_token='+_token+'&ID_simulador_ldm='+boton.attr('value')+'&identificador='+identificador;
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	$('#nomparcelasim').html(retorna.nomparcela);
           	$('#valorufhoysim').html(retorna.valoufhoy);
           	$('#valorlistauf').html(retorna.valorlistauf);
           	$('#dctootorgado').html(retorna.dctooto);
           	$('#valorventauf').html(retorna.valorventauf);
           	$('#tipocreditoldmsim').html(retorna.tipocreditosimldm);
           	$('#piesolicitadosim').html(retorna.piesolsim);
           	$('#pieufsim').html(retorna.pieufldmsim);
           	$('#piepesossim').html(retorna.piepesosldmsim);
           	$('#numcuotaldmsim').html(retorna.numcuotasldmsim);
           	$('#tasaanualsimldm').html(retorna.tasaanualsimldm);
           	$('#tasamensualsimldm').html(retorna.tasamensualsimldm);
           	$('#montofinansim').html(retorna.montofinansim);
           	$('#cuotafijasim').html(retorna.valorcuotafijasim);
           	$('#valorfinalcreditosim').html(retorna.valorfinalcreditosim);
           	$('.btn_imprimir_cuadro_simldm').attr('href', 'simulador_ldm/get_print_simulacion_cuotas_ldm/'+retorna.IDsimldm);
           	
           	if (retorna.idtipocreditosimldm == 1) {
		        $('#cuotafin').css('display', 'none');
		}else{
			$('#cuotafin').removeAttr('style');
			$('#cuotafiansimldm').html(retorna.coutafinalsimldm);
	           	$('#montocuotafiansimldm').html(retorna.montocoutafinalsimldm);
		}


           	show_table_simcuotas_ldm(retorna,tabla,identificador); 

        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

	function show_table_simcuotas_ldm(retorna,tabla,tipo){
	    tabla.clear().draw();
	    switch(tipo){
	        case 'sim_cuotas_ldm':
	            $.each(retorna.datos.simuladorldm_cuotasldm,function(indice,valor){
	                tabla.row.add([
	                   valor.ID_cuotas_sldm,
	                   ['<p style="text-align: center;">Cuota '+valor.SCLM_nro_cuota+'</p>'],
	                   ['<p style="text-align: center;">'+valor.SCLM_fecha_vencimiento+'</p>'],
	                   ['<p style="text-align: center;">'+valor.SCLM_saldo_ini+'</p>'],
	                   ['<p style="text-align: center;">'+valor.SCLM_valor_cuota+'</p>'],
	                   ['<p style="text-align: center;">'+valor.SCLM_interes+'</p>'],
	                   ['<p style="text-align: center;">'+valor.SCLM_abono+'</p>'],
	                   ['<p style="text-align: center;">'+valor.SCLM_capital+'</p>']

	             
	                  
	                ]).draw(false)
	     
	            });
	          	$('#mdl-cuadro-pagos-simulacion-ldm').modal('show');
	        break;

	          default:
	        break;
	        }
	}


function get_datos_simcuotas_cla(boton,ruta,tabla,identificador){
	var datos = '_token='+_token+'&ID_simulador_cla='+boton.attr('value')+'&identificador='+identificador;
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
        	$('#montoprestamosim_cla').html(retorna.prestamo_cla);
        	$('#numcuotassim_cla').html(retorna.numcuotasim_cla);
        	$('#valorcuotasim_cla').html(retorna.valorcuotasim_cla);
        	$('#tasaanualsim_cla').html(retorna.tasaanual_cla);
        	$('#tasamensualsim_cla').html(retorna.tasamensual_cla);
        	$('#totalsim_cla').html(retorna.totalsim_cla);
        	$('#costosim_cla').html(retorna.costosim_cla);
        	$('#capitalsim_cla').html(retorna.prestamo_cla);
        	$('#interessim_cla').html(retorna.interessim_cla);
        	$('#saldosim_cla').html(retorna.saldosim_cla);
        	$('.btn_imprimir_cuadro_scla').attr('href', 'simulador_cla/get_print_simulacion_cuotas_cla/'+retorna.IDsimcla);
           	console.log(retorna);
           	show_table_simcuotas_cla(retorna,tabla,identificador); 

        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

	function show_table_simcuotas_cla(retorna,tabla,tipo){
	    tabla.clear().draw();
	    switch(tipo){
	        case 'sim_cuotas_cla':
	            $.each(retorna.datos.simuladorcla_cuotascla,function(indice,valor){
	                tabla.row.add([
	                   valor.ID_cuota_scla,
	                   ['<p style="text-align: center;">Cuota '+valor.CCLA_nro_cuota+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CCLA_fecha_vencimiento+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CCLA_valor_cuota+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CCLA_capital+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CCLA_interes+'</p>'],
	                   ['<p style="text-align: center;">'+valor.CCLA_saldo+'</p>']

	             
	                  
	                ]).draw(false)
	     
	            });
	          	$('#mdl-cuadro-pagos-simulacion_cla').modal('show');
	        break;

	          default:
	        break;
	        }
	}





function get_datos_editar(boton,ruta,alias,modal,id_modelo, objeto = false, lbl_encabezado = null){
	var datos = '_token='+_token+'&'+id_modelo+'='+boton.attr('value');
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	if(lbl_encabezado != null){
           		$('#lbl_' + lbl_encabezado).html(retorna[lbl_encabezado]);
           	}
           	$.each(retorna,function(campo, valor) {
           		$('#'+alias+campo).val(valor);
           	});
           	$('select').trigger("chosen:updated");

           	if (retorna.PR_ruta_master != null) {
           		$('.master_img').html('<img class="card-img-top img-responsive" src="../img/masterp/'+retorna.PR_ruta_master+'">');
       		}else{
        		$('.master_img').html('No tiene');
        	}

           	$('#udppar').val('udp_pa'+retorna.ID_parcela);

           	$('#fechauf').html(retorna.PC_fecha_uf);
           	
           	$('#udpch').val('udp_chq'+retorna.ID_cheque);
           	if (retorna.CHQ_adjunto != null) {
           		$('.cheque_pdf').html('<a href="../storage/cheques_adj/'+retorna.CHQ_adjunto+'" target="_blank">'+retorna.CHQ_adjunto+'</a>');
       		}else{
        		$('.cheque_pdf').html('No tiene');
        	}
        	

        	if (retorna.CHQ_adjunto_comp != null) {
           		$('.cheque_comp_pdf').html('<a href="../storage/cheques_adj/comprobantes/'+retorna.CHQ_adjunto_comp+'" target="_blank">'+retorna.CHQ_adjunto_comp+'</a>');
       		}else{
        		$('.cheque_comp_pdf').html('No tiene');
        	}

        	$('#udpdocx').val('udp_docx'+retorna.ID_adj_cliente);
           	if (retorna.ACL_ruta != null) {
           		$('.clie_pdf').html('<a href="../storage/clientes_adj/'+retorna.ACL_ruta+'" target="_blank">'+retorna.ACL_ruta+'</a>');
       		}else{
        		$('.clie_pdf').html('No tiene');
        	}

        	if(retorna.PC_tipo_cambio == 1){
		    	$('#parcelaenufE').css('display', 'none');
		   
	   	}else{
			    $('#parcelaenufE').removeAttr('style');	    
	    	}

        	if(retorna.PC_forma_pago == 1){
		    	$('#credirectoE').removeAttr('style');
		        $('#contadoE').css('display', 'none');
		        $('#transmensualE').css('display', 'none');
		        var fvalorPieE_e = $('#EditaPAR_PC_pie').val(); 
			var fvalorResE_e = $('#EditaPAR_PC_reserva').val(); 
			var fvalorParE_e= $('#EditaPAR_PC_valor_parcela').val(); 
			var fresultadoE_e = parseInt(fvalorResE_e) + parseInt(fvalorPieE_e);
		   $('#EporcenPieRes').val((fresultadoE_e*100)/fvalorParE_e+'%');
	    	}else if (retorna.PC_forma_pago == 2) {
			    $('#contadoE').removeAttr('style');
			    $('#credirectoE').css('display', 'none');
			    $('#transmensualE').css('display', 'none');
	   	}else if (retorna.PC_forma_pago == 3) {
			    $('#transmensualE').removeAttr('style');
			    $('#credirectoE').css('display', 'none');
			    $('#contadoE').css('display', 'none');
	   	}else{
			    $('#contadoE').css('display', 'none');
			    $('#credirectoE').css('display', 'none');
			    $('#transmensualE').css('display', 'none');
	    	}

	    $('#updcuo').val('upd_cuo'+retorna.ID_cuota);

	    	var valorPieESM_e = $('#EditaSM_S_pie').val(); 
		var valorResESM_e = $('#EditaSM_S_reserva').val(); 
		var valorParESM_e= $('#EditaSM_S_valor_parcela').val(); 
		var resultadoESM_e = parseInt(valorResESM_e) + parseInt(valorPieESM_e);
	   	$('#EporcenPieResSim').val((resultadoESM_e*100)/valorParESM_e+'%');


	   	$('#updtrf').val('upd_trf'+retorna.ID_transferencia);

	   	if (retorna.TR_comprobante != null) {
           		$('.transfer_pdf').html('<a href="../storage/transf_adj/'+retorna.TR_comprobante+'" target="_blank">'+retorna.TR_comprobante+'</a>');
       		}else{
        		$('.transfer_pdf').html('No tiene');
        	}

        	if (retorna.PC_factura != null) {
           		$('.factura_pdf').html('<a href="../storage/parcelas_adj/'+retorna.PC_factura+'" target="_blank">'+retorna.PC_factura+'</a>');
       		}else{
        		$('.factura_pdf').html('No tiene');
        	}

        	if (retorna.PC_alzamiento != null) {
           		$('.alzamiento_pdf').html('<a href="../storage/parcelas_adj/'+retorna.PC_alzamiento+'" target="_blank">'+retorna.PC_alzamiento+'</a>');
       		}else{
        		$('.alzamiento_pdf').html('No tiene');
        	}


       
           	modal.modal('show');
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            boton.html(btn_text);
            boton.attr('disabled',false);
            plugin_alerta_error(retorna)
        }
    });
}

/*------------------------------------------------------------------------------------------------------*/

/*-------------------------------CREAR Y MODIFICAR-----------------------------------------------------------*/


function crear_set(datos,boton,ruta){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	plugin_alerta_success(retorna.titulo,retorna.msj,retorna.color,'aceptar')
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}

function crear_set_clientes(datos,boton,ruta){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        contentType: false,
		processData: false,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	plugin_alerta_success(retorna.titulo,retorna.msj,retorna.color,'aceptar')
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}

function crear_set_docx(datos,boton,ruta,opcion){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        contentType: false,
		processData: false,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);	
           	if (opcion == 'modificar') {	
           		Swal.fire({
					  title: '¡Documento modificado con éxito!',
					  text:'Se ha modificado el documento',
					  icon: 'success',
					  iconColor:'#ffc107',
					  confirmButtonColor: '#ffc107',
					  confirmButtonText: 'OK',
					  allowOutsideClick: false,
					 }).then((result) => {
			            if (result.isConfirmed) {
			            	$('#EditaCLD_ruta').val('');
							$("#"+retorna.request.udpdocx+"").parents('tr').find("td").eq(1).html('<p style="text-align: center;">'+retorna.modelo.ACL_nombre+'</p>');       	   
				           	$("#"+retorna.request.udpdocx+"").parents('tr').find("td").eq(2).html('<p style="text-align: center;">'+((retorna.modelo.ACL_ruta == null ) ? '-' : '<a href="../storage/clientes_adj/'+retorna.modelo.ACL_ruta+'" target="_blank">ADJUNTO</a>')+'</p>');
				           	$("#"+retorna.request.udpdocx+"").parents('tr').find("td").eq(3).html('<p style="text-align: center;">'+retorna.fechacre+'</p>');
				           	$("#"+retorna.request.udpdocx+"").parents('tr').find("td").eq(4).html('<p style="text-align: center;">'+retorna.fechact+'</p>');
				           	$("#"+retorna.request.udpdocx+"").parents('tr').find("td").eq(5).html('<p style="text-align: center;">'+retorna.estado+'</p>');
						}
					});

		           	$('#mdl-edita-doc-clientes').modal('hide');
			
			}else{
				$('#New_Doc').removeClass('show');
				$('#CLD_ACL_nombre').val('');
				$('#CLD_ACL_ruta').val('');
					Swal.fire({
					  title: '¡Documento agregado con exito!',
					  text:'Se ha agregado un documento',
					  icon: 'success',
					  iconColor:'#28a745',
					  confirmButtonColor: '#28a745',
					  confirmButtonText: 'OK',
					  allowOutsideClick: false,
					 }).then((result) => {
			            if (result.isConfirmed) {
							$('.ver_docx tbody').prepend('<tr><td style="text-align: center;">'+retorna.modelo.ID_adj_cliente+'</td>'
														+'<td><p style="text-align: center;">'+retorna.modelo.ACL_nombre+'</p></td>'
		 												+'<td><p style="text-align: center;">'+((retorna.modelo.ACL_ruta == null ) ? '-' : '<a href="../storage/clientes_adj/'+retorna.modelo.ACL_ruta+'" target="_blank">ADJUNTO</a>')+'</p></td>'
		 												+'<td><p style="text-align: center;">'+retorna.fechacre+'</p></td>'
		 												+'<td><p style="text-align: center;">'+retorna.fechact+'</p></td>'
		 												+'<td><p style="text-align: center;">'+retorna.estado+'</p></td>'
		 												+'<td style="width:10px;"><div class="btn-group">'
					           							+'<button type="button" class="btn btn-warning btn-sm btn_upd_docx" id="udp_docx'+retorna.modelo.ID_adj_cliente+'" value="'+retorna.modelo.ID_adj_cliente+'"><i class="fas fa-pencil-alt"></i></button>'
	                    								+'<button type="button" class="btn btn-danger btn-sm btn_del_docx" id="udp_docx'+retorna.modelo.ID_adj_cliente+'" value="'+retorna.modelo.ID_adj_cliente+'"><i class="fas fa-times"></i></button>'  
					                                    +'</div></td>'
		 												+'</tr>');
						}
					});

			}	

        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}




function crear_set_proyectos(datos,boton,ruta){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        contentType: false,
	processData: false,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	plugin_alerta_success(retorna.titulo,retorna.msj,retorna.color,'aceptar')
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}

function crear_set_parcelas(datos,boton,ruta,opcion){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        contentType: false,
		processData: false,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);	
           	if (opcion == 'modificar') {	
           		Swal.fire({
					  title: '¡Parcela Modificada con éxito!',
					  text:'Se ha modificado la parcela',
					  icon: 'success',
					  iconColor:'#ffc107',
					  confirmButtonColor: '#ffc107',
					  confirmButtonText: 'OK',
					  allowOutsideClick: false,
					 }).then((result) => {
			            if (result.isConfirmed) {
						$("#"+retorna.request.udppar+"").parents('tr').find("td").eq(1).html('<p style="text-align: center;">'+retorna.modelo.PC_num_parcela+'</p>');       	   
						$("#"+retorna.request.udppar+"").parents('tr').find("td").eq(2).html('<p style="text-align: center;">'+retorna.modelo.PC_nombre+'</p>');       	   
				           	$("#"+retorna.request.udppar+"").parents('tr').find("td").eq(3).html('<p style="text-align: center;">'+retorna.modelo.PC_admin_ant+'</p>');
				           	$("#"+retorna.request.udppar+"").parents('tr').find("td").eq(4).html('<p>'+retorna.cliente+'</p>');
				           	$("#"+retorna.request.udppar+"").parents('tr').find("td").eq(5).html(((retorna.forma_pago == 2) ? '<p style="text-align: center;"> Sin Cuotas </p>' :(retorna.forma_pago == 3) ? 'Transferencias Mensuales ' : '<p style="text-align: center;"><button type="button"  class="btn btn-link font-weight-bold btn_cuotas"  value="'+retorna.modelo.ID_parcela+'">'+retorna.cuotasCL+'</button></p>'));
				           	$("#"+retorna.request.udppar+"").parents('tr').find("td").eq(6).html(((retorna.forma_pago == 2) ? '<p style="text-align: center;"> Al Contado </p>' : (retorna.forma_pago == 3) ? '<p style="text-align: center;">'+retorna.transfeC+'/'+retorna.transfeCL+'</p>' :'<p style="text-align: center;">'+retorna.chq+'/'+retorna.cuotasCL+'</p>'
	           																																	+'<button type="button" class="btn btn-success btn-sm btn_cheques"  value="'+retorna.modelo.ID_parcela+'"><i class="fas fa-eye"></i> Cheques</button>')
	           																																		+((retorna.forma_pago == 3) ?'<button type="button" class="btn btn-secondary btn-sm btn_transf"  value="'+retorna.ID_parcela+'">Transferencias</button></div>' : '<p style="text-align: center;"> - </p>'));
				           	$("#"+retorna.request.udppar+"").parents('tr').find("td").eq(7).html('<p><strong>Creación:</strong><br>'+retorna.fechacre+'</p>'
				 																			+'<p><strong>Actualización:</strong><br>'+retorna.fechact+'</p>');
				           	$("#"+retorna.request.udppar+"").parents('tr').find("td").eq(8).html('<p style="text-align: center;"><button type="button" class="'+retorna.colorcomp+'">'+retorna.nomcomp +'</button></p>');
						}
					});

		           	$('#mdl-edita-parcelas').modal('hide');
			
			}else{
				$('#New_Parcela').removeClass('show');
				$('#PAR_PC_nombre').val('');
				$('#PAR_PC_admin_ant').val('');
				$("#PAR_ID_cliente option[value=0]").attr("selected",true).trigger("chosen:updated");
				$("#PAR_PC_tipo_cambio option[value=0]").attr("selected",true).trigger("chosen:updated");
				$('#PAR_PC_valor_parcela_uf').val('');
				$('#PAR_PC_valor_parcela').val('');
				$('#PAR_PC_reserva').val('');
				$('#PAR_PC_promesa').val('');
				$('#PAR_PC_pie').val('');
				$('#PAR_PC_forma_pago option[value=0]').attr("selected",true).trigger("chosen:updated");
				$('#PAR_PC_monto').val('');
				$('#PAR_PC_cupo_otorgado').val('');
				$('#PAR_PC_cant_cheques option[value=0]').attr("selected",true).trigger("chosen:updated");
				$('#PAR_PC_inicio_credito').val('');
				$('#PAR_PC_tasa_anual').val('');
				$('#PAR_PC_cant_transf option[value=0]').attr("selected",true).trigger("chosen:updated");
				$('#PAR_PC_cupo_otransf').val('');
				$('#PAR_PC_fecha_inicio_transf').val('');
				$('#PAR_PC_tasa_anual_transf').val('');

				$('#valparcelauf').css('display', 'none');
				$('#valparcela').css('display', 'none');
				$('#reserv').css('display', 'none');
				$('#pie').css('display', 'none');
				$('#comprav').css('display', 'none');
				$('#montocontado').css('display', 'none');
				$('#cupootor').css('display', 'none');
				$('#montotr').css('display', 'none');

					Swal.fire({
					  title: '¡Parcela agregada con exito!',
					  text:'Se ha agregado una Parcela',
					  icon: 'success',
					  iconColor:'#17a2b8',
					  confirmButtonColor: '#17a2b8',
					  confirmButtonText: 'OK',
					  allowOutsideClick: false,
					 }).then((result) => {
			            if (result.isConfirmed) {
					$('.ver_parcelas tbody').prepend('<tr><td style="text-align: center;">'+retorna.modelo.ID_parcela+'</td>'
												+'<td style="text-align: center;">'+retorna.modelo.PC_num_parcela+'</td>'
												+'<td><p style="text-align: center;">'+retorna.modelo.PC_nombre+'</p></td>'
												+'<td><p style="text-align: center;">'+retorna.modelo.PC_admin_ant+'</p></td>'
												+'<td><p>'+retorna.cliente+'</p></td>'
													+'<td>'+((retorna.forma_pago == 2) ? '<p style="text-align: center;"> Sin Cuotas </p>' : (retorna.forma_pago == 3) ? 'Transferencias Mensuales' : '<p style="text-align: center;"><button type="button"  class="btn btn-link font-weight-bold btn_cuotas"  value="'+retorna.modelo.ID_parcela+'">'+retorna.cuotasCL+'</button></p>')+'</td>'
													+'<td>'+((retorna.forma_pago == 2) ? '<p style="text-align: center;"> Al Contado </p>' : (retorna.forma_pago == 3) ? '<p style="text-align: center;">'+retorna.transfeC+'/'+retorna.transfeCL+'</p>' : '<p style="text-align: center;">'+retorna.chq+'/'+retorna.cuotasCL+'</p>'
													+'<button type="button" class="btn btn-success btn-sm btn_cheques"  value="'+retorna.modelo.ID_parcela+'"><i class="fas fa-eye"></i> Cheques</button>')
													+((retorna.forma_pago == 3) ?'<button type="button" class="btn btn-secondary btn-sm btn_transf"  value="'+retorna.modelo.ID_parcela+'">Transferencias</button></div>' : '<p style="text-align: center;"> - </p>')+'</td>'
													+'<td><p><strong>Creación:</strong><br>'+retorna.fechacre+'</p>'
													+'<p><strong>Actualización:</strong><br>'+retorna.fechact+'</p></td>'
													+'<td><p style="text-align: center;"><button type="button" class="'+retorna.colorcomp+'">'+retorna.nomcomp+'</button></p></td>'
													+'<td><p style="text-align: center;">'+retorna.estado+'</p></td>'
													+'<td style="width:10px;"><div class="btn-group-vertical">'
			           							+'<button type="button" class="btn btn-warning btn-sm btn_upd_parcela" id="udp_pa'+retorna.modelo.ID_parcela+'" value="'+retorna.modelo.ID_parcela+'"><i class="fas fa-pencil-alt"></i></button>'
	    								+'<button type="button" class="btn btn-danger btn-sm btn_del_parcela" id="udp_pa'+retorna.modelo.ID_parcela+'" value="'+retorna.modelo.ID_parcela+'"><i class="fas fa-times"></i></button>'   
	    								+'<button type="button" class="btn btn-success btn-sm btn_fin_parcela" id="udp_pa'+retorna.modelo.ID_parcela+'" value="'+retorna.modelo.ID_parcela+'"><i class="fas fa-check"></i></button>'   
			                                    +'<button type="button" class="btn btn-primary btn-sm btn_res_parcela" id="udp_pa'+retorna.modelo.ID_parcela+'" value="'+retorna.modelo.ID_parcela+'"><i class="fas fa-eye"></i></button>' 
			                                    +'</div></td>'
							    +'</tr>');
						}
					});

			}	

        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}


function crear_set_cuotas(datos,boton,ruta){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        contentType: false,
		processData: false,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	Swal.fire({
			  title: '¡Cuota Modificada!',
			  text:'Se ha modificado la cuota',
			  icon: 'success',
			  iconColor:'#ffc107',
			  confirmButtonColor: '#ffc107',
			  confirmButtonText: 'OK',
			  allowOutsideClick: false,
			 }).then((result) => {
	            if (result.isConfirmed) {
		           	$("#"+retorna.request.updcuo+"").parents('tr').find("td").eq(1).html('<p style="text-align: center;">Cuota '+retorna.nrocuota+'</p>');
		           	$("#"+retorna.request.updcuo+"").parents('tr').find("td").eq(2).html('<p style="text-align: center;">'+retorna.fechvec+'</p>');
		           	$("#"+retorna.request.updcuo+"").parents('tr').find("td").eq(3).html('<p style="text-align: center;">'+retorna.valorcuota+'</p>');
		           	$("#"+retorna.request.updcuo+"").parents('tr').find("td").eq(4).html('<p style="text-align: center;">'+retorna.estadocuota+'</p>');
		           	$("#"+retorna.request.updcuo+"").parents('tr').find("td").eq(5).html('<p style="text-align: center;">'+retorna.fechapago+'</p>');
				}
			});

	   	$('#mdl-edita-cuadro-pagos').modal('hide');
           	
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}




function crear_set_cheques(datos,boton,ruta,opcion){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        contentType: false,
		processData: false,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);	
           	if (opcion == 'modificar') {	
           		Swal.fire({
					  title: '¡Cheque modificado con éxito!',
					  text:'Se ha modificado el cheque',
					  icon: 'success',
					  iconColor:'#ffc107',
					  confirmButtonColor: '#ffc107',
					  confirmButtonText: 'OK',
					  allowOutsideClick: false,
					 }).then((result) => {
			            if (result.isConfirmed) {
			            	$('#EditaCHE_adjunto').val('');
			            	$('#EditaCHE_adjunto_comp').val('');
						$("#"+retorna.request.udpch+"").parents('tr').find("td").eq(1).html('<p style="text-align: center;">'+retorna.modelo.CHQ_titular+'</p>');       	   
				           	$("#"+retorna.request.udpch+"").parents('tr').find("td").eq(2).html('<p style="text-align: center;">$'+retorna.monto+'</p>');
				           	$("#"+retorna.request.udpch+"").parents('tr').find("td").eq(3).html('<p><strong>Banco:</strong><br>'+retorna.modelo.CHQ_banco+'</p>'
				 																				+'<p><strong>Nro Cuenta:</strong><br>'+retorna.modelo.CHQ_nro_cuenta+'</p>'
				 																				+'<p><strong>Nro Serie:</strong><br>'+retorna.modelo.CHQ_nro_serie+'</p>');
				           	$("#"+retorna.request.udpch+"").parents('tr').find("td").eq(4).html('<p style="text-align: center;">'+retorna.fechadep+'</p><br><p style="text-align: center;">Cuota '+retorna.cuotanom+'</p>');
				           	$("#"+retorna.request.udpch+"").parents('tr').find("td").eq(5).html('<p style="text-align: center;">'+((retorna.modelo.CHQ_comprobante_dep == null ) ? '-' : retorna.modelo.CHQ_comprobante_dep)+'</p>');
				           	$("#"+retorna.request.udpch+"").parents('tr').find("td").eq(6).html('<p style="text-align: center;">'+((retorna.modelo.CHQ_adjunto == null ) ? '-' : '<a href="../storage/cheques_adj/'+retorna.modelo.CHQ_adjunto+'" target="_blank">CHEQUE</a>')+'</p>'
				           																			+'<p style="text-align: center;">'+((retorna.modelo.CHQ_adjunto_comp == null ) ? '-' : '<a href="../storage/cheques_adj/comprobantes/'+retorna.modelo.CHQ_adjunto_comp+'" target="_blank">COMPROBANTE</a>')+'</p>');
				           	$("#"+retorna.request.udpch+"").parents('tr').find("td").eq(7).html('<p style="text-align: center;" class="'+retorna.colorECH+'">'+retorna.estadoCHQ+'</p>');
				           	$("#"+retorna.request.udpch+"").parents('tr').find("td").eq(8).html('<p><strong>Creación:</strong><br>'+retorna.fechacre+'</p>'
				 																			+'<p><strong>Actualización:</strong><br>'+retorna.fechact+'</p>');
						}
					});

		           	$('#mdl-edita-cheques').modal('hide');
			
			}else{
				$('#New_cheque').removeClass('show');
				$('#CHE_CHQ_titular').val('');
				$('#CHE_CHQ_monto').val('');
				$('#CHE_ID_cuota option[value=0]').attr("selected",true).trigger("chosen:updated");
				$('#CHE_CHQ_banco').val('');
				$('#CHE_CHQ_nro_cuenta').val('');
				$('#CHE_CHQ_nro_serie').val('');
				$('#CHE_CHQ_fecha_deposito').val('');
				$('#CHE_CHQ_comprobante_dep').val('');
				$('#CHE_CHQ_adjunto').val('');
					Swal.fire({
					  title: '¡Cheque agregado con exito!',
					  text:'Se ha agregado un cheque',
					  icon: 'success',
					  iconColor:'#28a745',
					  confirmButtonColor: '#28a745',
					  confirmButtonText: 'OK',
					  allowOutsideClick: false,
					 }).then((result) => {
			            if (result.isConfirmed) {
							$('.ver_cheques tbody').prepend('<tr><td style="text-align: center;">'+retorna.modelo.ID_cheque+'</td>'
														+'<td><p style="text-align: center;">'+retorna.modelo.CHQ_titular+'</p></td>'
														+'<td><p style="text-align: center;">$'+retorna.monto+'</p></td>'
		 												+'<td><p><strong>Banco:</strong><br>'+retorna.modelo.CHQ_banco+'</p>'
		 												+'<p><strong>Nro Cuenta:</strong><br>'+retorna.modelo.CHQ_nro_cuenta+'</p>'
		 												+'<p><strong>Nro Serie:</strong><br>'+retorna.modelo.CHQ_nro_serie+'</p></td>'
		 												+'<td><p style="text-align: center;">'+retorna.fechadep+'</p><br><p style="text-align: center;">Cuota '+retorna.cuotanom+'</p></td>'
		 												+'<td><p style="text-align: center;">'+((retorna.modelo.CHQ_comprobante_dep == null ) ? '-' : retorna.modelo.CHQ_comprobante_dep)+'</p></td>'
		 												+'<td><p style="text-align: center;">'+((retorna.modelo.CHQ_adjunto == null ) ? '-' : '<a href="../storage/cheques_adj/'+retorna.modelo.CHQ_adjunto+'" target="_blank">CHEQUE</a>')+'</p>'
		 													+'<p style="text-align: center;">'+((retorna.modelo.CHQ_adjunto_comp == null ) ? '-' : '<a href="../storage/cheques_adj/comprobantes/'+retorna.modelo.CHQ_adjunto_comp+'" target="_blank">COMPROBANTE</a>')+'</p></td>'
		 												+'<td><p style="text-align: center;" class="'+retorna.colorECH+'">'+retorna.estadoCHQ+'</p></td>'
		 												+'<td><p><strong>Creación:</strong><br>'+retorna.fechacre+'</p>'
		 												+'<p><strong>Actualización:</strong><br>'+retorna.fechact+'</p></td>'
		 												+'<td style="width:10px;"><div class="btn-group">'
					           							+'<button type="button" class="btn btn-warning btn-sm btn_upd_cheque" id="udp_chq'+retorna.modelo.ID_cheque+'" value="'+retorna.modelo.ID_cheque+'"><i class="fas fa-pencil-alt"></i></button>'
	                    								+'<button type="button" class="btn btn-danger btn-sm btn_del_cheque" id="udp_chq'+retorna.modelo.ID_cheque+'" value="'+retorna.modelo.ID_cheque+'"><i class="fas fa-times"></i></button>'   
					                                    +'</div></td>'
		 												+'</tr>');
						}
					});

			}	

        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}

function crear_set_transferencia(datos,boton,ruta,opcion){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        contentType: false,
		processData: false,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);	
           	if (opcion == 'modificar') {	
           		Swal.fire({
					  title: '¡Transferencia modificada con éxito!',
					  text:'Se ha modificado el cheque',
					  icon: 'success',
					  iconColor:'#ffc107',
					  confirmButtonColor: '#ffc107',
					  confirmButtonText: 'OK',
					  allowOutsideClick: false,
					 }).then((result) => {
			            if (result.isConfirmed) {
			            		$("#"+retorna.request.updtrf+"").parents('tr').find("td").eq(1).html('<p style="text-align: center; color: blue;">'+retorna.modelo.TR_titular+'</p>');       	   
				           	$("#"+retorna.request.updtrf+"").parents('tr').find("td").eq(2).html('<p style="text-align: center; color: blue;">$'+retorna.montoT+'</p>');
				           	$("#"+retorna.request.updtrf+"").parents('tr').find("td").eq(3).html('<p style="text-align: center; color: blue;">'+retorna.modelo.TR_banco+'</p>');
				 		$("#"+retorna.request.updtrf+"").parents('tr').find("td").eq(4).html('<p style="text-align: center; color: blue;">'+retorna.modelo.TR_cuenta+'</p>');
				 		$("#"+retorna.request.updtrf+"").parents('tr').find("td").eq(5).html('<p style="text-align: center; color: blue;">'+retorna.modelo.TR_numero+'</p>');
				           	$("#"+retorna.request.updtrf+"").parents('tr').find("td").eq(6).html('<p style="text-align: center; color: blue;">'+retorna.fechadep+'</p>');
				           	$("#"+retorna.request.updtrf+"").parents('tr').find("td").eq(7).html('<p style="text-align: center;">'+((retorna.modelo.TR_comprobante == null ) ? '-' : '<a href="../storage/transf_adj/'+retorna.modelo.TR_comprobante+'" target="_blank">COMPROBANTE</a>')+'</p>');
				           	$("#"+retorna.request.updtrf+"").parents('tr').find("td").eq(8).html('<p><strong>Creación:</strong><br>'+retorna.fechacre+'</p>'
				 																				+'<p><strong>Actualización:</strong><br>'+retorna.fechact+'</p>'
				 																				+'<p style="text-align: center;" class="'+retorna.colorTF+'">'+retorna.estadoTF+'</p>');
						}
					});

		           	$('#mdl-edita-transferencias').modal('hide');
			
			}else{
				$('#New_Transferencia').removeClass('show');
				$('#TRF_TR_titular').val('');
				$('#TRF_TR_monto').val('');
				$('#TRF_TR_banco').val('');
				$('#TRF_TR_cuenta').val('');
				$('#TRF_TR_numero').val('');
				$('#TRF_TR_fecha_deposito').val('');
				$('#TRF_TR_comprobante').val('');
					Swal.fire({
					  title: '¡Transferencia agregada con exito!',
					  text:'Se ha agregado una transferencia',
					  icon: 'success',
					  iconColor:'#28a745',
					  confirmButtonColor: '#28a745',
					  confirmButtonText: 'OK',
					  allowOutsideClick: false,
					 }).then((result) => {
			            if (result.isConfirmed) {
							$('.ver_transf tbody').prepend('<tr><td style="text-align: center;">'+retorna.modelo.ID_transferencia+'</td>'
												+'<td><p style="text-align: center;">'+retorna.modelo.TR_titular+'</p></td>'
												+'<td><p style="text-align: center;">$'+retorna.montoT+'</p></td>'
 												+'<td><p style="text-align: center;">'+retorna.modelo.TR_banco+'</p></td>'
 												+'<td><p style="text-align: center;">'+retorna.modelo.TR_cuenta+'</p></td>'
 												+'<td><p style="text-align: center;">'+retorna.modelo.TR_numero+'</p></td>'
 												+'<td><p style="text-align: center;">'+retorna.fechadep+'</p></td>'
 												+'<td><p style="text-align: center;">'+((retorna.modelo.TR_comprobante == null ) ? '-' : '<a href="../storage/transf_adj/'+retorna.modelo.TR_comprobante+'" target="_blank">COMPROBANTE</a>')+'</p>'
 												+'</td>'
 												+'<td><p><strong>Creación:</strong><br>'+retorna.fechacre+'</p>'
 												+'<p><strong>Actualización:</strong><br>'+retorna.fechact+'</p>'
 												+'<p style="text-align: center;" class="'+retorna.colorTF+'">'+retorna.estadoTF+'</p></td>'
 												+'<td style="width:10px;"><div class="btn-group">'
					           						+'<button type="button" class="btn btn-warning btn-sm btn_upd_transf" id="udp_trf'+retorna.modelo.ID_transferencia+'" value="'+retorna.modelo.ID_transferencia+'"><i class="fas fa-pencil-alt"></i></button>'
	                    								+'<button type="button" class="btn btn-danger btn-sm btn_del_transf" id="udp_trf'+retorna.modelo.ID_transferencia+'" value="'+retorna.modelo.ID_transferencia+'"><i class="fas fa-times"></i></button>'   
					                                    +'</div></td>'
		 												+'</tr>');
						}
					});

			}	

        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}



function crear_set_simulacion(datos,boton,ruta){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        contentType: false,
		processData: false,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	plugin_alerta_success(retorna.titulo,retorna.msj,retorna.color,'aceptar')
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}


function crear_set_tasa_anual(datos,boton,ruta){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        contentType: false,
		processData: false,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	plugin_alerta_success(retorna.titulo,retorna.msj,retorna.color,'aceptar')
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}


function crear_set_parcelas_ldm(datos,boton,ruta){
    boton.attr('disabled',true);
    btn_text = boton.html();
    boton.html('Espere...');
    $.ajax({
        type: 'POST',
        url: ruta,
        data: datos,
        contentType: false,
	processData: false,
        success: function(retorna) {
           	console.log(retorna);
           	boton.html(btn_text);
           	boton.attr('disabled',false);
           	plugin_alerta_success(retorna.titulo,retorna.msj,retorna.color,'aceptar');
        },
        error:function(retorna){
            if(retorna.status == 419){
                location.reload();
                return
            }
            console.log(retorna)
            $('.strong-default').html('');
            boton.html(btn_text);
            boton.attr('disabled',false);
            $.each(retorna.responseJSON.errors,function(campo,mensage_arr){
                var txt_mensage = '';
                $.each(mensage_arr,function(indice,mensage){
                    txt_mensage+=mensage+'<br>';
                })
                $('#error-'+campo).html(txt_mensage);
            });
            plugin_alerta_error(retorna)
        }
    });
}


/*------------------------------------------------------------------------------------------------------*/

function plugin_alerta_success(titulo,contenido,color,txt_boton_si, reload = true){
	Swal.fire({
		  	icon: color,
		  	title: titulo,
		    text: contenido,
		    confirmButtonColor: '#28a745',
		}).then(function(isConfirm) {
		  if (isConfirm) {
		    location.reload();
		  } else {
		    //if no clicked => do something else
		  }
	});
		
}

function plugin_alerta_error(error){
	if(error.status!=422){
        Swal.fire({
		  	icon: 'error',
		  	title: 'Error',
		  	confirmButtonColor: '#dc3545',
		    buttons: [
			    'NO',
			    'YES'
	  	],
		}).then(function(isConfirm) {
		  if (isConfirm) {
		    location.reload();
		  } else {
		    //if no clicked => do something else
		  }
	});
    }
}