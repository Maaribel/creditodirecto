<div id="mdl-cuadro-pagos-simulacion-ldm" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-primary">   
                        <div class="text-center">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="font-weight-bold text-center">Simulaci&oacute;n Cuadro de Pagos LDM</h1>
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-primary btn_imprimir_cuadro_simldm" href="#" ><i class="fa fa-download"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                             <table class="table table-bordered">
                                <tbody style="white-space: pre-line;">
                                    <tr>
                                        <td  colspan="3"><h3 class="font-weight-bold">PARCELA: <label id="nomparcelasim"></label></h3></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">VALOR LISTA: <label id="valorlistauf"  style="font-size: 18px;"></label></td>
                                        <td class="font-weight-bold">DCTO OTORGADO: <label id="dctootorgado" style="font-size: 18px;"></label></td>
                                        <td class="font-weight-bold">VALOR VENTA: <label id="valorventauf" style="font-size: 18px;"></label></td>
                                    </tr>
                                    <tr>
                                       <td class="font-weight-bold alert alert-primary">CONDICIONES DEL CR&Eacute;DITO: </td>
                                       <td class="font-weight-bold alert alert-primary" colspan="2"><label id="tipocreditoldmsim" style="font-size: 18px;"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">PIE SOLICITADO: <label id="piesolicitadosim" style="font-size: 18px;"></label></td>
                                        <td class="font-weight-bold">TASA ANUAL: <label id="tasaanualsimldm" style="font-size: 18px;"></td>
                                        <td class="font-weight-bold">CUOTAS: <label id="numcuotaldmsim" style="font-size: 18px;"></label></td>
                                    </tr>
                                    
                                    <tr>
                                         <td class="font-weight-bold">MONTO PIE: <label id="pieufsim" style="font-size: 18px;"></label></td>
                                        <td class="font-weight-bold">TASA MENSUAL:  <label id="tasamensualsimldm" style="font-size: 18px;"></label></td>
                                    </tr>

                                     <tr id="cuotafin" style="display:none;">
                                        <td class="font-weight-bold">CUOTA FINAL: <label id="cuotafiansimldm" style="font-size: 18px;"></td>
                                        <td class="font-weight-bold">MONTO CUOTA FINAL: <label id="montocuotafiansimldm" style="font-size: 18px;"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">MONTO A FINANCIAR: <label id="montofinansim" style="font-size: 18px;"></label></td>
                                        <td class="font-weight-bold">CUOTA FIJA: <label id="cuotafijasim" style="font-size: 18px;"></label></td>
                                        <td class="font-weight-bold">VALOR FINAL CR&Eacute;DITO: <label id="valorfinalcreditosim" style="font-size: 18px;"></label></td>
                                    </tr>     
                                </tbody>
                            </table>
                            <br>
                            <div class="table-responsive">
                            <table class="table table-bordered ver_cuadro_pagos_simldm">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;  text-align: center;">#</th>
                                        <th style="width: 30px;  text-align: center;">Nro Cuota</th>
                                        <th style="width: 100px; text-align: center;">Fecha Vencimiento</th>
                                        <th style="width: 100px; text-align: center;">Saldo Inicial</th>
                                        <th style="width: 100px; text-align: center;">Cuota</th>
                                        <th style="width: 100px; text-align: center;">Inter&eacute;ses</th>
                                        <th style="width: 100px; text-align: center;">Abono Capital</th>
                                        <th style="width: 100px; text-align: center;">Saldo Capital</th>
                                    </tr>
                                </thead>
                                <tbody style="white-space: pre-line;">
                                     
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

