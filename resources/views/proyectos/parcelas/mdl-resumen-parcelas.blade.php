<div id="mdl-resumen-parcelas" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-primary">   
                        <div class="text-center">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="font-weight-bold text-center">Resumen Parcelas</h1>
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-primary btn_imprimir_res" href="#" ><i class="fa fa-download"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-primary">
                            <h3 class="font-weight-bold" align="center"><label id="nomPC"></label></h3>
                        </div>
                        <div class="card">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>CLIENTE</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_cliente"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>VALOR PARCELA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_valor_parcela"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>RESERVA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_reserva_parcela"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>COMPRAVENTA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_compraventa"></label>
                                        </td>
                                    </tr>
                                    <tr  id="res_pie" style="display:none;">
                                        <td>PIE</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_pie_parcela"></label>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>FORMA DE PAGO</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_forma_pago"></label>
                                        </td>
                                    </tr>
                                    
                                    <tr id="res_contado" style="display:none;">
                                        <td>MONTO</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_monto_contado"></label>
                                        </td>
                                    </tr>


                                    
                                    <tr id="res_fechaiT" style="display:none;">
                                        <td>FECHA INICIO TRANSFERENCIAS</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_fecha_iniT"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_cupoT" style="display:none;">
                                        <td>CUPO OTORGADO</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_cupoT"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_tasanualT" style="display:none;">
                                        <td>TASA INTER&Eacute;S ANUAL</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_tasa_interesT"></label>
                                        </td>
                                    <tr id="res_ntransfer" style="display:none;">
                                        <td>CUOTAS - CREDITO</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_ntransfer"></label>
                                        </td>
                                    </tr>
                                     <tr id="res_cuotaT" style="display:none;">
                                        <td>VALOR CUOTA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_cuotaT"></label>
                                        </td>
                                    </tr>

                                    <tr id="res_UcuotaT" style="display:none;">
                                        <td>FECHA &Uacute;LTIMA CUOTA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_UcuotaT"></label>
                                        </td>
                                    </tr>

                                    
                                    <tr id="res_cuotasatrasadasT" style="display:none;">
                                        <td>CUOTAS EN MORA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_cuotas_atrasadasT"></label>
                                        </td>
                                    </tr>
                                     <tr id="res_montoatrasadoT" style="display:none;">
                                        <td>MONTO EN MORA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_monto_atrasadoT"></label>
                                        </td>
                                    </tr>
                                     <tr id="res_cuotaspagadasT" style="display:none;">
                                        <td>CUOTAS PAGADAS A LA FECHA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_cuotas_pagadasT"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_montopagadoT" style="display:none;">
                                        <td>MONTO PAGADO A LA FECHA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_monto_pagadoT"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_saldoporpagarT" style="display:none;">
                                        <td>SALDO POR PAGAR</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_saldoT"></label>
                                        </td>



                                    <tr id="res_fechaI" style="display:none;">
                                        <td>FECHA INICIO CRÉDITO</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_inicio_credito"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_cupo" style="display:none;">
                                        <td>CUPO OTORGADO</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_cupo"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_tasanual" style="display:none;">
                                        <td>TASA INTERÉS ANUAL</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_tasa_interes"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_cantcheques" style="display:none;">
                                        <td>CANTIDAD DE CHEQUES</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_cant_cheques"></label>
                                        </td>
                                    </tr>
                                     <tr id="res_fechaUC" style="display:none;">
                                        <td>FECHA FIN ÚLTIMA CUOTA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_ultima_cuota"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_valorcuota" style="display:none;">
                                        <td>VALOR CUOTA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_valor_cuota"></label>
                                        </td>
                                    </tr>
                                     
                                    <tr id="res_cuotasatrasadas" style="display:none;">
                                        <td>CUOTAS EN MORA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_cuotas_atrasadas"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_montoatrasado" style="display:none;">
                                        <td>MONTO EN MORA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_monto_atrasado"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_cuotaspagadas" style="display:none;">
                                        <td>CUOTAS PAGADAS A LA FECHA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_cuotas_pagadas"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_montopagado" style="display:none;">
                                        <td>MONTO PAGADO A LA FECHA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_monto_pagado"></label>
                                        </td>
                                    </tr>
                                    <tr id="res_saldoporpagar" style="display:none;">
                                        <td>SALDO POR PAGAR</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_saldo"></label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

