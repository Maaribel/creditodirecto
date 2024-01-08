<div id="mdl-edita-cheques" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header">   
                        <div class="text-center">
                            <h1>Editar Cheque</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_edita_cheque" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="EditaCHE_ID_cheque" id="EditaCHE_ID_cheque">
                            <input type="hidden" name ="udpch" id="udpch" value="">
                            <input type="hidden" name ="EditaCHE_ID_parcela" id="EditaCHE_ID_parcela">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Titular Cheque (*)</th>
                                            <th class="alert alert-warning">Monto (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaCHE_CHQ_titular" id="EditaCHE_CHQ_titular" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_CHQ_titular" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="number" name="EditaCHE_CHQ_monto" id="EditaCHE_CHQ_monto" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_CHQ_monto" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Cuota (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select type="select" name="EditaCHE_ID_cuota" id="EditaCHE_ID_cuota" class="form-control chosen lg">
                                                            <option value="0">Seleccione</option>
                                                            @foreach($cuotaspar as $id => $nombre)
                                                                <option value="{{ $id }}">Cuota {{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_ID_cuota" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Banco (*)</th>
                                            <th class="alert alert-warning">Nro Cuenta (*)</th>
                                            <th class="alert alert-warning">Nro Serie (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaCHE_CHQ_banco" id="EditaCHE_CHQ_banco" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_CHQ_banco" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="EditaCHE_CHQ_nro_cuenta" id="EditaCHE_CHQ_nro_cuenta" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_CHQ_nro_cuenta" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="EditaCHE_CHQ_nro_serie" id="EditaCHE_CHQ_nro_serie" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_CHQ_nro_serie" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Fecha Depósito (*)</th>
                                            <th class="alert alert-warning">Comprobante Depósito</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="EditaCHE_CHQ_fecha_deposito" id="EditaCHE_CHQ_fecha_deposito" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_CHQ_fecha_deposito" class='strong-default'></strong>
                                                    </span>
                                                </td>

                                                <td><input type="text" name="EditaCHE_CHQ_comprobante_dep" id="EditaCHE_CHQ_comprobante_dep" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_CHQ_comprobante_dep" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Adjunto Cheque</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="file" name="EditaCHE_adjunto" id="EditaCHE_adjunto" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_adjunto" class='strong-default'></strong>
                                                    </span>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td class="alert alert-warning">Adjunto Actual</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="cheque_pdf"></td>
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
                                            <th class="alert alert-warning">Adjunto Comprobante</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="file" name="EditaCHE_adjunto_comp" id="EditaCHE_adjunto_comp" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_adjunto_comp" class='strong-default'></strong>
                                                    </span>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td class="alert alert-warning">Adjunto Actual</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="cheque_comp_pdf"></td>
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
                                            <th class="alert alert-warning">Estado Cheque</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                 <td><select type="select" name="EditaCHE_ID_estado_cheque" id="EditaCHE_ID_estado_cheque" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($estadoche as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCHE_ID_estado_cheque" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_edita_cheques" class="btn btn-warning btn-lg btn-block">Guardar Cambios
                                    </button>
                                    <br>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>