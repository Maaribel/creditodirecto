<div id="mdl-edita-parcelas" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header">   
                        <div class="text-center">
                            <h1>Editar Parcela</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_edita_parcela" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="EditaPAR_ID_parcela" id="EditaPAR_ID_parcela">
                             <input type="hidden" name ="udppar" id="udppar" value="">
                             <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">N° Parcela(*)</th>
                                            <th class="alert alert-warning">Nombre Parcela(*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="number" name="EditaPAR_PC_num_parcela" id="EditaPAR_PC_num_parcela" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_num_parcela" class='strong-default'></strong>
                                                    </span>
                                                </td>     
                                                <td><input type="text" name="EditaPAR_PC_nombre" id="EditaPAR_PC_nombre" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_nombre" class='strong-default'></strong>
                                                    </span>
                                                </td>                                              
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Admin. Anterior (*)</th>
                                            <th class="alert alert-warning">Propietario (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaPAR_PC_admin_ant" id="EditaPAR_PC_admin_ant" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_admin_ant" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><select type="select" name="EditaPAR_ID_cliente" id="EditaPAR_ID_cliente" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($clientes as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_ID_cliente" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Moneda (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="EditaPAR_PC_tipo_cambio" id="EditaPAR_PC_tipo_cambio" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                                <option value="1">Pesos</option>
                                                                <option value="2">UF</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_tipo_cambio" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="parcelaenufE" style="display: none;">
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Valor UF hoy</th>
                                            <th class="alert alert-warning">Fecha UF</th>
                                            <th class="alert alert-warning">Valor Parcela UF</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaPAR_PC_valor_uf_dia" id="EditaPAR_PC_valor_uf_dia" class="form-control">
                                                    <hr>
                                                    <div align="center">UF del dia: <p id="fechauf"></p></div>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_valor_uf_dia" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                 <td><input type="date" name="EditaPAR_PC_fecha_uf" id="EditaPAR_PC_fecha_uf" class="form-control">
                                                    <hr>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_fecha_uf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="EditaPAR_PC_valor_parcela_uf" id="EditaPAR_PC_valor_parcela_uf" class="form-control">
                                                    <hr>
                                                    <p id="valparcelaufE" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_valor_parcela_uf" class='strong-default'></strong>
                                                    </span>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>


                              <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Valor Parcela (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaPAR_PC_valor_parcela" id="EditaPAR_PC_valor_parcela" class="form-control">
                                                    <p id="valparcelaE" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_valor_parcela" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Reserva</th>
                                            <th class="alert alert-warning">Pie</th>
                                            <th class="alert alert-warning">Compraventa</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaPAR_PC_reserva" id="EditaPAR_PC_reserva" class="form-control">
                                                    <p id="reservE" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_reserva" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="EditaPAR_PC_pie" id="EditaPAR_PC_pie" class="form-control">
                                                     <p id="pieE" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_pie" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="EditaPAR_PC_promesa" id="EditaPAR_PC_promesa" class="form-control">
                                                    <p id="compravE" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_promesa" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="text" name="EporcenPieRes" id="EporcenPieRes" class="form-control" readonly></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Forma de Pago (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="EditaPAR_PC_forma_pago" id="EditaPAR_PC_forma_pago" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                                <option value="1">Credito Directo</option>
                                                                <option value="2">Contado</option>
                                                                <option value="3">Transferencia Mensual</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_forma_pago" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="contadoE"  style="display: none;">
                                <div class="form-group row">
                                    <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                    <div class="col-md-10">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="alert alert-warning">Monto Contado (*)</th>
                                            </tr>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="EditaPAR_PC_monto" id="EditaPAR_PC_monto" class="form-control">
                                                        <span class="invalid-feedback">
                                                            <strong id="error-EditaPAR_PC_monto" class='strong-default'></strong>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="credirectoE" style="display: none;">
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Cupo Otorgado (*)</th>
                                            <th class="alert alert-warning">Cantidad de Cheques (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaPAR_PC_cupo_otorgado" id="EditaPAR_PC_cupo_otorgado" class="form-control">
                                                    <p id="cupootorE" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_cupo_otorgado" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><select type="select" name="EditaPAR_PC_cant_cheques" id="EditaPAR_PC_cant_cheques" class="form-control chosen lg">
                                                                <option value="">Seleccione</option>
                                                                <option value="12">12</option>
                                                                <option value="24">24</option>
                                                                <option value="36">36</option>
                                                                <option value="48">48</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_cant_cheques" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Fecha Inicio Crédito (*)</th>
                                            <th class="alert alert-warning">Tasa Anual (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="EditaPAR_PC_inicio_credito" id="EditaPAR_PC_inicio_credito" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_inicio_credito" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="EditaPAR_PC_tasa_anual" id="EditaPAR_PC_tasa_anual" class="form-control" placeholder="decimal con . ej 15.4...">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_tasa_anual" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                            <div id="transmensualE" style="display: none;">
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Cupo Otorgado (*)</th>
                                            <th class="alert alert-warning">Cantidad de Transferencia (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaPAR_PC_cupo_otransf" id="EditaPAR_PC_cupo_otransf" class="form-control">
                                                     <hr>
                                                    <p id="montotr" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_cupo_otransf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><select type="select" name="EditaPAR_PC_cant_transf" id="EditaPAR_PC_cant_transf" class="form-control chosen lg">
                                                                <option value="">Seleccione</option>
                                                                <option value="12">12</option>
                                                                <option value="24">24</option>
                                                                <option value="36">36</option>
                                                                <option value="48">48</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_cant_transf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Fecha Inicio Transferencia (*)</th>
                                            <th class="alert alert-warning">Tasa Anual Transferencia(*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="EditaPAR_PC_fecha_inicio_transf" id="EditaPAR_PC_fecha_inicio_transf" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_fecha_inicio_transf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="EditaPAR_PC_tasa_anual_transf" id="EditaPAR_PC_tasa_anual_transf" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_PC_tasa_anual_transf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                             </div>


                             <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Factura</th>
                                            <th class="alert alert-warning">Alzamiento</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="file" name="EditaPAR_factura" id="EditaPAR_factura" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_factura" class='strong-default'></strong>
                                                    </span>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td class="alert alert-warning">Adjunto Actual</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="factura_pdf"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td><input type="file" name="EditaPAR_alzamiento" id="EditaPAR_alzamiento" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_alzamiento" class='strong-default'></strong>
                                                    </span>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td class="alert alert-warning">Adjunto Actual</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="alzamiento_pdf"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Comportamiento Pago (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="EditaPAR_ID_comp_pago" id="EditaPAR_ID_comp_pago" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($comportamiento as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaPAR_ID_comp_pago" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_edita_parcela" class="btn btn-warning btn-lg btn-block">Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>