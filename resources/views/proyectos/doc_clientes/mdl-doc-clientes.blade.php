<div id="mdl-doc-clientes" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-secondary">   
                        <div class="text-center">
                            <h1>Documentos</h1>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-secondary">
                            <h3 class="font-weight-bold" align="center"><label class="nomCL"></label></h3>
                        </div>

                        <div class="alert alert-secondary">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4 class="font-weight-bold">NUEVO DOCUMENTO</h4>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#New_Doc" aria-expanded="false" aria-controls="New_Doc">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="New_Doc">
                        <form id="frm_nuevo_documento" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="CLD_ID_cliente" id="CLD_ID_cliente">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-secondary">Nombre Documento(*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="CLD_ACL_nombre" id="CLD_ACL_nombre" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CLD_ACL_nombre" class='strong-default'></strong>
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
                                            <th class="alert alert-secondary">Archivo Adjunto (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="file" name="CLD_ACL_ruta" id="CLD_ACL_ruta" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CLD_ACL_ruta" class='strong-default'></strong>
                                                    </span>
                                                </td>                                             
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_new_docx" class="btn btn-secondary btn-lg btn-block">Guardar
                                    </button>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>

                    
                       <div class="alert alert-secondary">
                        <h4 class="font-weight-bold">DOCUMENTOS</h4>    
                    </div>
                        <div class="card">
                            <table class="table table-bordered ver_docx">
                                <thead>
                                    <tr>
                                    <th style="width: 30px;  text-align: center;">#</th>
                                    <th style="width: 150px; text-align: center;">Nombre</th>
                                    <th style="width: 150px; text-align: center;">Archivo</th>
                                    <th style="width: 60px; text-align: center;">Creación</th>
                                    <th style="width: 60px; text-align: center;">Actualización</th>
                                    <th style="width: 60px; text-align: center;">Estado</th>
                                    <th style="width: 60px; text-align: center;">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody style="white-space: pre-line;">
                                     
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>