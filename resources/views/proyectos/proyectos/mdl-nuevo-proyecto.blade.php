<div id="mdl-nuevo-proyecto" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-dark">   
                        <div class="text-center">
                            <h1>Nueva Etapa</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_nuevo_proyecto" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p>Los campos con (*) son obligatorios</p>

                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-dark">Proyecto (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="ID_proyecto_macro" id="ID_proyecto_macro" class="form-control chosen lg">
                                                            @foreach($proymacro as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-ID_proyecto_macro" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Nombre (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="PR_nombre" id="PR_nombre" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PR_nombre" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Descripci&oacute;n</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><textarea type="text" name="PR_descripcion" id="PR_descripcion" class="form-control"></textarea>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PR_descripcion" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Fecha Inicio Ventas (*)</th>
                                            <th class="alert alert-dark">Total de Unidades (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="PR_fecha_inicio_ventas" id="PR_fecha_inicio_ventas" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PR_fecha_inicio_ventas" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="number" name="PR_total_unidades" id="PR_total_unidades" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PR_total_unidades" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Master Plan</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input  type="file" name="PR_ruta_master" id="PR_ruta_master" class="form-control" accept="image/*">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-PR_ruta_master" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_nuevo_proyecto" class="btn btn-dark btn-lg btn-block">Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>