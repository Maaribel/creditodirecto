<div id="mdl-edita-proyecto" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-warning">   
                        <div class="text-center">
                            <h1>Edita Etapa</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_edita_proyecto" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="EditaP_ID_proyecto" id="EditaP_ID_proyecto">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Nombre (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaP_PR_nombre" id="EditaP_PR_nombre" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaP_PR_nombre" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Descripci&oacute;n</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><textarea type="text" name="EditaP_PR_descripcion" id="EditaP_PR_descripcion" class="form-control"></textarea>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaP_PR_descripcion" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Fecha Inicio Ventas (*)</th>
                                            <th class="alert alert-warning">Total de Unidades (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="EditaP_PR_fecha_inicio_ventas" id="EditaP_PR_fecha_inicio_ventas" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaP_PR_fecha_inicio_ventas" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="number" name="EditaP_PR_total_unidades" id="EditaP_PR_total_unidades" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaP_PR_total_unidades" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Master Plan</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input  type="file" name="EditaP_ruta_master" id="EditaP_ruta_master" class="form-control" accept="image/*">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaP_ruta_master" class='strong-default'></strong>
                                                    </span>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td class="alert alert-warning">Adjunto Actual</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="master_img"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_editar_proyecto" class="btn btn-warning btn-lg btn-block">Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>