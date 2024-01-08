<div id="mdl-nueva-simulacion" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-dark">   
                        <div class="text-center">
                            <h1>Nueva Simulación</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_nueva_simulacion" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-dark">Etapa Proyecto (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="ID_tasa_anual" id="ID_tasa_anual" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($tasa_anual as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}%</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-ID_tasa_anual" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Nombre Cliente (*)</th>
                                            <th class="alert alert-dark">Nombre Parcela (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="S_nombre_cliente" id="S_nombre_cliente" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_nombre_cliente" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="S_nom_parcela" id="S_nom_parcela" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_nom_parcela" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">UF Hoy</th>
                                            <th class="alert alert-dark">Valor Parcela UF</th>                                           
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="S_uf_hoy" id="S_uf_hoy" class="form-control" >
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_uf_hoy" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="S_valor_parcela_uf" id="S_valor_parcela_uf" class="form-control">
                                                    <hr><p id="valparcelaufSM" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_valor_parcela_uf" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Valor Parcela (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="number" name="S_valor_parcela" id="S_valor_parcela" class="form-control">
                                                     <hr><p id="valparcelaSM" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_valor_parcela" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Reserva</th>
                                            <th class="alert alert-dark">Pie</th>
                                            <th class="alert alert-dark">Compraventa</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="number" name="S_reserva" id="S_reserva" class="form-control">
                                                    <hr><p id="reservSM" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_reserva" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="number" name="S_pie" id="S_pie" class="form-control">
                                                     <hr><p id="pieSM" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_pie" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="number" name="S_compraventa" id="S_compraventa" class="form-control">
                                                    <hr><p id="compravSM" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_compraventa" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="text" name="porcenPieResSim" id="porcenPieResSim" class="form-control" readonly></td>
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
                                            <th class="alert alert-dark">Cupo Otorgado (*)</th>
                                            <th class="alert alert-dark">Cantidad de Cheques (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="number" name="S_cupo_otorgado" id="S_cupo_otorgado" class="form-control">
                                                    <hr><p id="cupootorSM" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_cupo_otorgado" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><select type="select" name="S_cantidad_cheques" id="S_cantidad_cheques" class="form-control chosen lg">
                                                                <option value="">Seleccione</option>
                                                                <option value="12">12</option>
                                                                <option value="24">24</option>
                                                                <option value="36">36</option>
                                                                <option value="35">35</option>
                                                                <option value="34">34</option>
                                                                <option value="60">60</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_cantidad_cheques" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Fecha Inicio Crédito (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="S_fecha_inicio_credito" id="S_fecha_inicio_credito" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-S_fecha_inicio_credito" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_add_simulacion" class="btn btn-dark btn-lg btn-block">Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>