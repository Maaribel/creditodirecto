<div id="mdl-nueva-simulacion_ldm" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-dark">   
                        <div class="text-center">
                            <h1>Nueva Simulaci&oacute;n</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_nueva_simulacion_ldm" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-dark">Parcela (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="ID_parcela_lista" id="ID_parcela_lista" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($listaparcelas as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-ID_parcela_lista" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Datos del Cliente  (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><textarea type="text" name="SLM_datos_cliente" id="SLM_datos_cliente" class="form-control" rows="4"></textarea>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_datos_cliente" class='strong-default'></strong>
                                                    </span> </td>
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
                                            <th class="alert alert-dark">Valor UF HOY (decimales con . )  (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="SLM_valorufhoy" id="SLM_valorufhoy" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_valorufhoy" class='strong-default'></strong>
                                                    </span> </td>
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
                                            <th class="alert alert-dark"> (*) </th>
                                            <th class="alert alert-dark" align="center">UF</th>
                                            <th class="alert alert-dark">Pesos</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td>Valor Lista UF</td>
                                                <td><input type="text" name="SLM_valorlistauf" id="SLM_valorlistauf" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_valorlistauf" class='strong-default'></strong>
                                                    </span></td>
                                                    <td><input type="text" name="SLM_valorlistapesos" id="SLM_valorlistapesos" class="form-control" readonly>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_valorlistapesos" class='strong-default'></strong>
                                                    </span></td>
                                            </tr>
                                            <tr>
                                                <td>Descuento %</td>
                                                <td><input type="text" name="SLM_descuento" id="SLM_descuento" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_descuento" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Valor Venta UF</td>
                                                <td><input type="text" name="SLM_valorventauf" id="SLM_valorventauf" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_valorventauf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="SLM_valorventapesos" id="SLM_valorventapesos" class="form-control" readonly>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_valorventapesos" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Tipo  de Cr&eacute;dito(*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="SLM_tipo_credito" id="SLM_tipo_credito" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                                <option value="1">Cr&eacute;dito Normal</option>
                                                                <option value="2">Cr&eacute;dito Cuota Liviana</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_tipo_credito" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Condiciones del Cr&eacute;dito  (*)</th>
                                            <th class="alert alert-dark" align="center">UF</th>
                                            <th class="alert alert-dark">Pesos</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td>Pie Solicitado %</td>
                                                <td><input type="text" name="SLM_pie_solicitado" id="SLM_pie_solicitado" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_pie_solicitado" class='strong-default'></strong>
                                                    </span> </td>
                                                    <td></td>
                                            </tr>
                                            <tr>
                                                <td>Monto Pie (UF)</td>
                                                <td><input type="text" name="SLM_monto_pie" id="SLM_monto_pie" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_monto_pie" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="SLM_monto_pie_pesos" id="SLM_monto_pie_pesos" class="form-control" readonly>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_monto_pie_pesos" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                            
                                            <tr id="cuotalivpor" style="display: none;">
                                                <td>Cuota Final %</td>
                                                    <td><input type="text" name="SLM_cuota_final" id="SLM_cuota_final" class="form-control">
                                                        <span class="invalid-feedback">
                                                            <strong id="error-SLM_cuota_final" class='strong-default'></strong>
                                                        </span> </td>
                                                        <td></td>
                                                </tr>
                                            <tr>
                                                <tr id="cuotaliv" style="display: none;">
                                                <td>Monto Cuota Final UF</td>
                                                    <td><input type="text" name="SLM_monto_cuota_final" id="SLM_monto_cuota_final" class="form-control">
                                                        <span class="invalid-feedback">
                                                            <strong id="error-SLM_monto_cuota_final" class='strong-default'></strong>
                                                        </span> </td>
                                                        <td><input type="text" name="SLM_cuota_final_pesos" id="SLM_cuota_final_pesos" class="form-control" readonly>
                                                        <span class="invalid-feedback">
                                                            <strong id="error-SLM_cuota_final_pesos" class='strong-default'></strong>
                                                        </span></td>
                                                </tr>
                                            <tr>
                                                <td>Saldo a Financiar</td>
                                                <td><input type="text" name="SLM_cupo_otorgado" id="SLM_cupo_otorgado" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_cupo_otorgado" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="SLM_cupo_otorgado_pesos" id="SLM_cupo_otorgado_pesos" class="form-control" readonly>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_cupo_otorgado_pesos" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Fecha Promesa  (*) </th>
                                            <th class="alert alert-dark">Cuotas  (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="SLM_fecha_promesa" id="SLM_fecha_promesa" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SLM_fecha_promesa" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><select type="select" name="ID_ncuotas_uf" id="ID_ncuotas_uf" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($cuotasldm as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-ID_ncuotas_uf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> 

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_add_simulacion_ldm" class="btn btn-dark btn-lg btn-block">Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>