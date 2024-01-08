<div id="mdl-edita-transferencias" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header  alert-warning">   
                        <div class="text-center">
                            <h1>Editar Transferencia</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_edita_transf" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="EditaTRF_ID_transferencia" id="EditaTRF_ID_transferencia">
                            <input type="hidden" name ="updtrf" id="updtrf" value="">
                            <input type="hidden" name ="EditaTRF_ID_parcela" id="EditaTRF_ID_parcela">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Titular (*)</th>
                                            <th class="alert alert-warning">Monto (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaTRF_TR_titular" id="EditaTRF_TR_titular" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaTRF_TR_titular" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="number" name="EditaTRF_TR_monto" id="EditaTRF_TR_monto" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaTRF_TR_monto" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Cuenta (*)</th>
                                            <th class="alert alert-warning">Numero (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaTRF_TR_banco" id="EditaTRF_TR_banco" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaTRF_TR_banco" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="EditaTRF_TR_cuenta" id="EditaTRF_TR_cuenta" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaTRF_TR_cuenta" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="EditaTRF_TR_numero" id="EditaTRF_TR_numero" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaTRF_TR_numero" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Fecha Dep&oacute;sito (*)</th>
                                            <th class="alert alert-warning">Comprobante Depósito</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="EditaTRF_TR_fecha_deposito" id="EditaTRF_TR_fecha_deposito" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaTRF_TR_fecha_deposito" class='strong-default'></strong>
                                                    </span>
                                                </td>

                                                <td><input type="file" name="EditaTRF_comprobante" id="EditaTRF_comprobante" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaTRF_comprobante" class='strong-default'></strong>
                                                    </span>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td class="alert alert-warning">Adjunto Actual</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="transfer_pdf"></td>
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
                                            <th class="alert alert-warning">Estado (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                              
                                                <td><select type="select" name="EditaTRF_ID_estado_transfer" id="EditaTRF_ID_estado_transfer" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($estadotransfer as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaTRF_ID_estado_transfer" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_edita_transf" class="btn btn-warning btn-lg btn-block">Guardar
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