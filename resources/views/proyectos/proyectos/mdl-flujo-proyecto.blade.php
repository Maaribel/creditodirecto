<div class="no_imprime">
<div id="mdl-flujo-proyecto" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-primary">   
                        <div class="text-center">

                            <div class="row">
                                <div class="col-md-10">
                                    <h1 class="font-weight-bold text-center">Flujo Proyecto</h1>
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-primary btn_imprimir" href="#" ><i class="fa fa-download"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-primary">
                            <h3 class="font-weight-bold" align="center"><label id="nomPro"></label></h3>
                        </div>
                        <div class="card">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>FECHA INICIO DE VENTAS</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_fechaIV"></label>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>TOTAL UNIDADES PROYECTO</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_uniproy"></label>
                                        </td>
                                    </tr>
                                    
                                    <tr style="display:none;">
                                        <td>MONTO PROYECTADO A RECAUDAR (UF)</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_monto_uf"></label>
                                        </td>
                                     
                                    </tr>
                                    <tr>
                                        <td>UNIDADES VENDIDAS AL CONTADO</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_univencont"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PORCENTAJE DE VENTAS AL CONTADO</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_poruniventcont"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>UNIDADES VENDIDAS CON CRÉDITO DIRECTO</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_univentCD"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PORCENTAJE DE VENTAS CON CRÉDITO DIRECTO</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_poruniventCD"></label>
                                        </td>
                                    </tr>
                                     <tr class="alert alert-success">
                                        <td class="font-weight-bold">MONTO TOTAL RECAUDADO DE UNIDADES VENDIDAS A LA FECHA</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_montoTRUVF"></label>
                                        </td>
                                    </tr>
                                    <tr  class="alert alert-success">
                                        <td class="font-weight-bold">MONTO TOTAL RECAUDADO DE UNIDADES VENDIDAS A LA FECHA CON C.D</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_montoTRUVFCD"></label>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>CANTIDAD DE CHEQUES RECEPCIONADOS A LA FECHA</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_cantchqrecfecha"></label>
                                        </td>
                                    </tr>
                                    <tr style="display:none;">
                                        <td>MONTO TOTAL EN DOCUMENTOS BANCARIOS A LA FECHA</td>
                                        <td class="font-weight-bold">
                                            <label id="tr_montoTDBF"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>N° DE CHEQUES A DEPOSITAR MENSUAL</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_nchqdm"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FLUJO $ MENSUAL POR CHEQUES A DEPOSITAR </td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_fmchqd"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CHEQUES PROTESTADOS NO PAGADOS HISTÓRICO</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_chqprnopaghis"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MONTO TOTAL DE CHEQUES PROTESTADOS NO PAGADOS HISTÓRICO</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_montochqprnopaghis"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CHEQUES PROTESTADOS NO PAGADOS ACTUALES</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_chqprnopagact"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MONTO TOTAL CHEQUES PROTESTADOS NO PAGADOS ACTUALES</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_montochqprnopagact"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FECHA FINAL DE VENTAS DEL PROYECTO</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_fechfinvenproy"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FECHA DEL ÚLTIMO CHEQUE A COBRAR</td>
                                        <td class="font-weight-bold" style="font-size: 20px;">
                                            <label id="tr_fechulchqcob"></label>
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
   </div>
    