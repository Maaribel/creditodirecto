<div id="mdl-nueva-simulacion_cla" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-dark">   
                        <div class="text-center">
                            <h1>Nueva Simulaci&oacute;n</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_nueva_simulacion_cla" enctype="multipart/form-data">
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
                                                <td><input type="text" name="SCLA_nom_proyecto" id="SCLA_nom_proyecto" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_nom_proyecto" class='strong-default'></strong>
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
                                                <td><input type="text" name="SCLA_nom_cliente" id="SCLA_nom_cliente" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_nom_cliente" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="SCLA_nom_parcela" id="SCLA_nom_parcela" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_nom_parcela" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Fecha UF</th>
                                            <th class="alert alert-dark">Valor Parcela UF</th>                                           
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="SCLA_uf_hoy" id="SCLA_uf_hoy" class="form-control" >
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_uf_hoy" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="date" name="SCLA_fecha_uf_dia" id="SCLA_fecha_uf_dia" class="form-control" >
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_fecha_uf_dia" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="SCLA_valor_parcela_uf" id="SCLA_valor_parcela_uf" class="form-control">
                                                    <hr><p id="valparcelaufSMcla" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_valor_parcela_uf" class='strong-default'></strong>
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
                                                <td><input type="number" name="SCLA_valor_parcela" id="SCLA_valor_parcela" class="form-control">
                                                     <hr><p id="valparcelaSMcla" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_valor_parcela" class='strong-default'></strong>
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
                                                <td><input type="text" name="SCLA_reserva" id="SCLA_reserva" class="form-control">
                                                    <hr><p id="reservSMcla" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_reserva" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="SCLA_pie" id="SCLA_pie" class="form-control">
                                                     <hr><p id="pieSMcla" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_pie" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="SCLA_compraventa" id="SCLA_compraventa" class="form-control">
                                                    <hr><p id="compravSMcla" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_compraventa" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="text" name="porcenPieResSimcla" id="porcenPieResSimcla" class="form-control" readonly></td>
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
                                                <td><input type="number" name="SCLA_cupo_otorgado" id="SCLA_cupo_otorgado" class="form-control">
                                                    <hr><p id="cupootorSMcla" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_cupo_otorgado" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><select type="select" name="SCLA_cantidad_cheques" id="SCLA_cantidad_cheques" class="form-control chosen lg">
                                                                <option value="">Seleccione</option>
                                                                <option value="12">12</option>
                                                                <option value="24">24</option>
                                                                <option value="36">36</option>
                                                                <option value="48">48</option>
                                                                <option value="60">60</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_cantidad_cheques" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Tasa Anual (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="SCLA_fecha_inicio_credito" id="SCLA_fecha_inicio_credito" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_fecha_inicio_credito" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="SCLA_tasa_anual" id="SCLA_tasa_anual" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-SCLA_tasa_anual" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_add_simulacion_cla" class="btn btn-dark btn-lg btn-block">Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>