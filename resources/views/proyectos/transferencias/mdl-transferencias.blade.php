<div id="mdl-transferencias" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-secondary">   
                        <div class="text-center">
                            <h1>Transferencias</h1>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-secondary">
                            <h3 class="font-weight-bold" align="center"><label class="nomPartr"></label></h3>
                        </div>

                        <div id="add_transf">
                        <div class="alert alert-secondary">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4 class="font-weight-bold">NUEVA TRANSFERENCIA</h4>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#New_Transferencia" aria-expanded="false" aria-controls="New_Transferencia">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="New_Transferencia">
                        <form id="frm_nueva_transf" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="TRF_ID_parcela" id="TRF_ID_parcela">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-secondary">Titular (*)</th>
                                            <th class="alert alert-secondary">Monto (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="TRF_TR_titular" id="TRF_TR_titular" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-TRF_TR_titular" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="number" name="TRF_TR_monto" id="TRF_TR_monto" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-TRF_TR_monto" class='strong-default'></strong>
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
                                            <th class="alert alert-secondary">Banco (*)</th>
                                            <th class="alert alert-secondary">Cuenta (*)</th>
                                            <th class="alert alert-secondary">Numero (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="TRF_TR_banco" id="TRF_TR_banco" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-TRF_TR_banco" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="TRF_TR_cuenta" id="TRF_TR_cuenta" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-TRF_TR_cuenta" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="TRF_TR_numero" id="TRF_TR_numero" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-TRF_TR_numero" class='strong-default'></strong>
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
                                            <th class="alert alert-secondary">Fecha Dep&oacute;sito (*)</th>
                                            <th class="alert alert-secondary">Comprobante Depósito</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="TRF_TR_fecha_deposito" id="TRF_TR_fecha_deposito" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-TRF_TR_fecha_deposito" class='strong-default'></strong>
                                                    </span>
                                                </td>

                                                <td><input type="file" name="TRF_TR_comprobante" id="TRF_TR_comprobante" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-TRF_TR_comprobante" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_new_transf" class="btn btn-secondary btn-lg btn-block">Guardar
                                    </button>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    
                       <div class="alert alert-secondary">
                        <h4 class="font-weight-bold">TRANSFERENCIAS</h4>    
                    </div>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-bordered ver_transf">
                                    <thead>
                                        <tr>
                                        <th style="width: 30px;  text-align: center;">#</th>
                                        <th style="width: 100px; text-align: center;">Titular</th>
                                        <th style="width: 70px; text-align: center;">Monto</th>
                                        <th style="width: 70px; text-align: center;">Banco</th>
                                        <th style="width: 70px; text-align: center;">Cuenta</th>
                                        <th style="width: 70px; text-align: center;">N&uacute;mero</th>
                                        <th style="width: 60px; text-align: center;">Fecha Dep&oacute;sito</th>
                                        <th style="width: 60px; text-align: center;">Comprobante</th>
                                        <th style="width: 60px; text-align: center;">Registro</th>
                                        <th style="width: 90px; text-align: center;">Opciones</th>
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
    </div>