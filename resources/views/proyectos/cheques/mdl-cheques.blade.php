<div id="mdl-cheques" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-success">   
                        <div class="text-center">
                            <h1>Cheques</h1>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success">
                            <h3 class="font-weight-bold" align="center"><label class="nomPar"></label></h3>
                        </div>

                        <div id="add_chq">
                        <div class="alert alert-success">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4 class="font-weight-bold">NUEVO CHEQUE</h4>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#New_cheque" aria-expanded="false" aria-controls="New_cheque">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="New_cheque">
                        <form id="frm_nuevo_cheque" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="CHE_ID_parcela" id="CHE_ID_parcela">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-success">Titular Cheque (*)</th>
                                            <th class="alert alert-success">Monto (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="CHE_CHQ_titular" id="CHE_CHQ_titular" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CHE_CHQ_titular" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="number" name="CHE_CHQ_monto" id="CHE_CHQ_monto" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CHE_CHQ_monto" class='strong-default'></strong>
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
                                            <th class="alert alert-success">Cuota (*)  (Cliente: <label class="nomcli"></label>)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select type="select" name="CHE_ID_cuota" id="CHE_ID_cuota" class="form-control chosen lg">
                                                            <option value="0">Seleccione</option>
                                                            @foreach($cuotaspar as $id => $nombre)
                                                                <option value="{{ $id }}">Cuota {{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CHE_ID_cuota" class='strong-default'></strong>
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
                                            <th class="alert alert-success">Banco (*)</th>
                                            <th class="alert alert-success">Nro Cuenta (*)</th>
                                            <th class="alert alert-success">Nro de Serie (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="CHE_CHQ_banco" id="CHE_CHQ_banco" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CHE_CHQ_banco" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="CHE_CHQ_nro_cuenta" id="CHE_CHQ_nro_cuenta" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CHE_CHQ_nro_cuenta" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="CHE_CHQ_nro_serie" id="CHE_CHQ_nro_serie" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CHE_CHQ_nro_serie" class='strong-default'></strong>
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
                                            <th class="alert alert-success">Fecha Depósito (*)</th>
                                            <th class="alert alert-success">Comprobante Depósito</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="CHE_CHQ_fecha_deposito" id="CHE_CHQ_fecha_deposito" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CHE_CHQ_fecha_deposito" class='strong-default'></strong>
                                                    </span>
                                                </td>

                                                <td><input type="text" name="CHE_CHQ_comprobante_dep" id="CHE_CHQ_comprobante_dep" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CHE_CHQ_comprobante_dep" class='strong-default'></strong>
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
                                            <th class="alert alert-success">Adjunto Cheque</th>
                                            <th class="alert alert-success">Adjunto Comprobante</th>
                                            
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="file" name="CHE_CHQ_adjunto" id="CHE_CHQ_adjunto" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CHE_CHQ_adjunto" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="file" name="CHE_CHQ_adjunto_comp" id="CHE_CHQ_adjunto_comp" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CHE_CHQ_adjunto_comp" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_new_cheques" class="btn btn-success btn-lg btn-block">Guardar
                                    </button>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    
                       <div class="alert alert-success">
                        <h4 class="font-weight-bold">CHEQUES</h4>    
                    </div>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-bordered ver_cheques">
                                    <thead>
                                        <tr>
                                        <th style="width: 30px;  text-align: center;">#</th>
                                        <th style="width: 100px; text-align: center;">Titular</th>
                                        <th style="width: 150px; text-align: center;">Monto</th>
                                        <th style="width: 100px; text-align: center;">Datos</th>
                                        <th style="width: 60px; text-align: center;">Fecha Depósito</th>
                                        <th style="width: 60px; text-align: center;">Comprobante</th>
                                        <th style="width: 60px; text-align: center;">Adjuntos</th>
                                        <th style="width: 40px; text-align: center;">Estado</th>
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