<div id="mdl-edita-simulacion" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-warning">   
                        <div class="text-center">
                            <h1>Edita Simulación</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_edita_simulacion" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="EditaSM_ID_simulador" id="EditaSM_ID_simulador">

                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Etapa Proyecto (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="EditaSM_ID_tasa_anual" id="EditaSM_ID_tasa_anual" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($tasa_anual as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaSM_ID_tasa_anual" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Nombre Cliente (*)</th>
                                            <th class="alert alert-warning">Nombre Parcela (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaSM_S_nombre_cliente" id="EditaSM_S_nombre_cliente" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaSM_S_nombre_cliente" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="EditaSM_S_nom_parcela" id="EditaSM_S_nom_parcela" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaSM_S_nom_parcela" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Valor Parcela (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="number" name="EditaSM_S_valor_parcela" id="EditaSM_S_valor_parcela" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaSM_S_valor_parcela" class='strong-default'></strong>
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
                                                <td><input type="number" name="EditaSM_S_reserva" id="EditaSM_S_reserva" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaSM_S_reserva" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="number" name="EditaSM_S_pie" id="EditaSM_S_pie" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaSM_S_pie" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="number" name="EditaSM_S_compraventa" id="EditaSM_S_compraventa" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaSM_S_compraventa" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="text" name="EporcenPieResSim" id="EporcenPieResSim" class="form-control" readonly></td>
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
                                            <th class="alert alert-warning">Cupo Otorgado (*)</th>
                                            <th class="alert alert-warning">Cantidad de Cheques (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="number" name="EditaSM_S_cupo_otorgado" id="EditaSM_S_cupo_otorgado" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaSM_S_cupo_otorgado" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><select type="select" name="EditaSM_S_cantidad_cheques" id="EditaSM_S_cantidad_cheques" class="form-control chosen lg">
                                                                <option value="">Seleccione</option>
                                                                <option value="12">12</option>
                                                                <option value="24">24</option>
                                                                <option value="36">36</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaSM_S_cantidad_cheques" class='strong-default'></strong>
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
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="EditaSM_S_fecha_inicio_credito" id="EditaSM_S_fecha_inicio_credito" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaSM_S_fecha_inicio_credito" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_upd_simulacion" class="btn btn-warning btn-lg btn-block">Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>