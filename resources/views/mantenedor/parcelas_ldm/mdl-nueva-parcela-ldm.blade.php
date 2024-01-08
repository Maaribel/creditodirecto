<div id="mdl-nueva-parcela-ldm" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-dark">   
                        <div class="text-center">
                            <h1>Nueva Parcela LDM</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_nueva_parcela_ldm" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="font-weight-bold">NOMBRE (*): </td>
                                                <td><input type="text" name="PLM_nombre" id="PLM_nombre" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PLM_nombre" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">VALOR LISTA (*): </td>
                                                <td><input type="text" name="PLM_valor_lista" id="PLM_valor_lista" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PLM_valor_lista" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">DESCUENTO (*): </td>
                                                <td><input type="text" name="PLM_descuento" id="PLM_descuento" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PLM_descuento" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">VALOR VENTA (*): </td>
                                                <td><input type="text" name="PLM_valor_venta" id="PLM_valor_venta" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PLM_valor_venta" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_add_parcela_ldm" class="btn btn-dark btn-lg btn-block">Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>