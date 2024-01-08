<div id="mdl-nuevo-cliente" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-dark">   
                        <div class="text-center">
                            <h1>Nuevo Cliente</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_nuevo_cliente" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p>Los campos con (*) son obligatorios</p>
                            <div class="form-group row">
                                <label for="" class="col-md-1 col-form-label text-md-right font-weight-bold"></label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="alert alert-dark">Nombre (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="CL_nombre" id="CL_nombre" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CL_nombre" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Etapa (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><select type="select" name="ID_proyecto" id="ID_proyecto" class="form-control chosen lg">
                                                                <option value="0">Seleccione</option>
                                                            @foreach($proyectos as $id => $nombre)
                                                                <option value="{{ $id }}">{{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    <span class="invalid-feedback">
                                                        <strong id="error-ID_proyecto" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Rut (*)</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="CL_rut" id="CL_rut" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CL_rut" class='strong-default'></strong>
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
                                            <th class="alert alert-dark">Telefono</th>
                                            <th class="alert alert-dark">Correo</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="CL_telefono" id="CL_telefono" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CL_telefono" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                                <td><input type="email" name="CL_correo" id="CL_correo" class="form-control">
                                                    <span class="invalid-feedback">
                                                        <strong id="error-CL_correo" class='strong-default'></strong>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_nuevo_cliente" class="btn btn-dark btn-lg btn-block">Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>