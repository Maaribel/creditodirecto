<div id="mdl-edita-cliente" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-warning">   
                        <div class="text-center">
                            <h1>Edita Cliente</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_edita_cliente" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="EditaC_ID_cliente" id="EditaC_ID_cliente">
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
                                                <td><input type="text" name="EditaC_CL_nombre" id="EditaC_CL_nombre" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaC_CL_nombre" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Etapa (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="EditaC_ID_proyecto" id="EditaC_ID_proyecto" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($proyectos as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaC_ID_proyecto" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Rut (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaC_CL_rut" id="EditaC_CL_rut" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaC_CL_rut" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Telefono</th>
                                            <th class="alert alert-warning">Correo</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaC_CL_telefono" id="EditaC_CL_telefono" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaC_CL_telefono" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="email" name="EditaC_CL_correo" id="EditaC_CL_correo" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaC_CL_correo" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_editar_cliente" class="btn btn-warning btn-lg btn-block">Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>