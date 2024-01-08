<div id="mdl-edita-doc-clientes" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-warning">   
                        <div class="text-center">
                            <h1>Edita Documento</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_edita_documento" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="EditaCLD_ID_adj_cliente" id="EditaCLD_ID_adj_cliente">
                            <input type="hidden" name ="udpdocx" id="udpdocx" value="">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-warning">Nombre Documento(*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="EditaCLD_ACL_nombre" id="EditaCLD_ACL_nombre" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCLD_ACL_nombre" class='strong-default'></strong>
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
                                            <th class="alert alert-warning">Archivo Adjunto (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="file" name="EditaCLD_ruta" id="EditaCLD_ruta" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-EditaCLD_ruta" class='strong-default'></strong>
                                                    </span>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td class="alert alert-warning">Adjunto Actual</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="clie_pdf"></td>
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
                                    <button type="submit" id="btn_edita_docx" class="btn btn-warning btn-lg btn-block">Guardar Cambios
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