<div id="mdl-edita-cuadro-pagos" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-warning">   
                        <div class="text-center">
                            <h1>Edita Cuotas</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_edita_cuadro_pagos" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="EditaCU_ID_cuota" id="EditaCU_ID_cuota">
                            <input type="hidden" name ="updcuo" id="updcuo" value="">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Fecha Vencimiento (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="EditaCU_CT_fecha_vencimiento" id="EditaCU_CT_fecha_vencimiento" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCU_CT_fecha_vencimiento" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Valor Cuota (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="number" name="EditaCU_CT_valor_cuota" id="EditaCU_CT_valor_cuota" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCU_CT_valor_cuota" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Estado Cuota (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select type="select" name="EditaCU_ID_estado_cuota" id="EditaCU_ID_estado_cuota" class="form-control chosen lg">
                                                            <option value="0">Seleccione</option>
                                                            @foreach($estadocuota as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCU_ID_estado_cuota" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_edita_cuota" class="btn btn-warning btn-lg btn-block">Guardar Cambios
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