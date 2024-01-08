<div id="mdl-parcelas" class="modal  fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-info">   
                        <div class="text-center">
                            <h1>Parcelas</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h3 class="font-weight-bold" align="center"><label class="nomTax"></label></h3>
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <th class="alert alert-info text-center">MASTER PLAN</th>
                            </tr>
                            <tbody>
                                <tr>
                                    <td class="masterplan text-center"></td>
                                </tr>
                            </tbody>
                        </table>

                        <div id="add_par">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4 class="font-weight-bold">NUEVA PARCELA <label id="usdd"></label></h4>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#New_Parcela" aria-expanded="false" aria-controls="New_Parcela">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="New_Parcela">
                        <form id="frm_nueva_parcela" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="PAR_ID_proyecto" id="PAR_ID_proyecto">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-info">N° Parcela(*)</th>
                                            <th class="alert alert-info">Nombre Parcela(*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="number" name="PAR_PC_num_parcela" id="PAR_PC_num_parcela" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_num_parcela" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="PAR_PC_nombre" id="PAR_PC_nombre" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_nombre" class='strong-default'></strong>
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
                                            <th class="alert alert-info">Admin. Anterior (*)</th>
                                            <th class="alert alert-info">Propietario (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="PAR_PC_admin_ant" id="PAR_PC_admin_ant" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_admin_ant" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><select type="select" name="PAR_ID_cliente" id="PAR_ID_cliente" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($clientes as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_ID_cliente" class='strong-default'></strong>
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
                                            <th class="alert alert-info">Moneda (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="PAR_PC_tipo_cambio" id="PAR_PC_tipo_cambio" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                                <option value="1">Pesos</option>
                                                                <option value="2">UF</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_tipo_cambio" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="parcelaenuf" style="display: none;">
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-info">Valor UF hoy</th>
                                            <th class="alert alert-info">Fecha UF</th>
                                            <th class="alert alert-info">Valor Parcela UF</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                
                                                <td><input type="text" name="PAR_PC_valor_uf_dia" id="PAR_PC_valor_uf_dia" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_valor_uf_dia" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="date" name="PAR_PC_fecha_uf" id="PAR_PC_fecha_uf" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_fecha_uf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="PAR_PC_valor_parcela_uf" id="PAR_PC_valor_parcela_uf" class="form-control">
                                                    <hr>
                                                    <p id="valparcelauf" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_valor_parcela_uf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-info">Valor Parcela (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="PAR_PC_valor_parcela" id="PAR_PC_valor_parcela" class="form-control">
                                                    <hr>
                                                    <p id="valparcela" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_valor_parcela" class='strong-default'></strong>
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
                                            <th class="alert alert-info">Reserva</th>
                                            <th class="alert alert-info">Pie</th>
                                            <th class="alert alert-info">Compraventa</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="PAR_PC_reserva" id="PAR_PC_reserva" class="form-control">
                                                     <hr>
                                                    <p id="reserv" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_reserva" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="PAR_PC_pie" id="PAR_PC_pie" class="form-control">
                                                     <hr>
                                                    <p id="pie" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_pie" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="PAR_PC_promesa" id="PAR_PC_promesa" class="form-control">
                                                     <hr>
                                                    <p id="comprav" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_promesa" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="text" name="porcenPieRes" id="porcenPieRes" class="form-control" readonly></td>
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
                                            <th class="alert alert-info">Forma de Pago (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="PAR_PC_forma_pago" id="PAR_PC_forma_pago" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                                <option value="1">Credito Directo</option>
                                                                <option value="2">Contado</option>
                                                                <option value="3">Transferencia Mensual</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_forma_pago" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="contado"  style="display: none;">
                                <div class="form-group row">
                                    <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                    <div class="col-md-10">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="alert alert-info">Monto Contado (*)</th>
                                            </tr>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="PAR_PC_monto" id="PAR_PC_monto" class="form-control">
                                                        <hr>
                                                    <p id="montocontado" align="center"></p>
                                                        <span class="invalid-feedback">
                                                            <strong id="error-PAR_PC_monto" class='strong-default'></strong>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="credirecto" style="display: none;">
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-info">Cupo Otorgado (*)</th>
                                            <th class="alert alert-info">Cantidad de Cheques (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="PAR_PC_cupo_otorgado" id="PAR_PC_cupo_otorgado" class="form-control">
                                                     <hr>
                                                    <p id="cupootor" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_cupo_otorgado" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><select type="select" name="PAR_PC_cant_cheques" id="PAR_PC_cant_cheques" class="form-control chosen lg">
                                                                <option value="">Seleccione</option>
                                                                <option value="12">12</option>
                                                                <option value="24">24</option>
                                                                <option value="36">36</option>
                                                                <option value="48">48</option>
                                                                <option value="60">60</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_cant_cheques" class='strong-default'></strong>
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
                                            <th class="alert alert-info">Fecha Inicio Crédito (*)</th>
                                            <th class="alert alert-info">Tasa Anual (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="PAR_PC_inicio_credito" id="PAR_PC_inicio_credito" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_fecha_inicio_credito" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="PAR_PC_tasa_anual" id="PAR_PC_tasa_anual" class="form-control" placeholder="decimal con . ej 15.4...">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_tasa_anual" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                            <div id="transmensual" style="display: none;">
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-info">Cupo Otorgado (*)</th>
                                            <th class="alert alert-info">Cantidad de Transferencia (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="PAR_PC_cupo_otransf" id="PAR_PC_cupo_otransf" class="form-control">
                                                     <hr>
                                                    <p id="montotr" align="center"></p>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_cupo_otransf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><select type="select" name="PAR_PC_cant_transf" id="PAR_PC_cant_transf" class="form-control chosen lg">
                                                                <option value="">Seleccione</option>
                                                                <option value="12">12</option>
                                                                <option value="24">24</option>
                                                                <option value="36">36</option>
                                                                <option value="48">48</option>
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_cant_transf" class='strong-default'></strong>
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
                                            <th class="alert alert-info">Fecha Inicio Transferencia (*)</th>
                                            <th class="alert alert-info">Tasa Anual Transferencia(*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="PAR_PC_fecha_inicio_transf" id="PAR_PC_fecha_inicio_transf" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_fecha_inicio_transf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="text" name="PAR_PC_tasa_anual_transf" id="PAR_PC_tasa_anual_transf" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PAR_PC_tasa_anual_transf" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                             </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_new_parcela" class="btn btn-info btn-lg btn-block">Guardar
                                    </button>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    
                       <div class="alert alert-info">
                        <h4 class="font-weight-bold">PARCELAS</h4>    
                    </div>
                        <div class="card">
                            <div class="table-responsive">
                            <table class="table table-bordered ver_parcelas">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;  text-align: center;">#</th>
                                        <th style="width: 30px;  text-align: center;">N° P</th>
                                        <th style="width: 100px; text-align: center;">Nombre Parcela</th>
                                        <th style="width: 100px; text-align: center;">Admin. Anterior </th>
                                        <th style="width: 130px; text-align: center;">Cliente</th>
                                        <th style="width: 90px; text-align: center;">Cuotas</th>
                                        <th style="width: 60px; text-align: center;">Cheques</th>
                                        <th style="width: 60px; text-align: center;">Registro</th>
                                        <th style="width: 60px; text-align: center;">Comp. Pago</th>
                                        <th style="width: 60px; text-align: center;">Estado</th>
                                        <th style="width: 90px; text-align: center;"></th>
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