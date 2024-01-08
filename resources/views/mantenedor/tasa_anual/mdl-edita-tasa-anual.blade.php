<div id="mdl-edita-tasa-anual" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-warning">   
                        <div class="text-center">
                            <h1>Edita Tasa Anual</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_edita_tasa_anual" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="EditaTA_ID_tasa_anual" id="EditaTA_ID_tasa_anual">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Nombre Etapa(*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaTA_TA_nom_proyecto" id="EditaTA_TA_nom_proyecto" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaTA_TA_nom_proyecto" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Tasa Anual (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaTA_TA_tasa_anual" id="EditaTA_TA_tasa_anual" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaTA_TA_tasa_anual" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_upd_tasa_anual" class="btn btn-warning btn-lg btn-block">Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>