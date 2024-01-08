    <div id="mdl-edita-usuario" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-warning">   
                        <div class="text-center">
                            <h1>Edita Usuario </h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm_edita_usuario">
                            @csrf
                            <input type="hidden" name="Edita_ID_usuario" id="Edita_ID_usuario">
                            <div class="form-group row">
                                <label for="Edita_U_rut" class="col-md-4 col-form-label text-md-right font-weight-bold">Rut Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="Edita_U_rut" id="Edita_U_rut" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-Edita_U_rut" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Edita_U_nombres" class="col-md-4 col-form-label text-md-right font-weight-bold">Nombres Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="Edita_U_nombres" id="Edita_U_nombres" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-Edita_U_nombres" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Edita_U_apellidos" class="col-md-4 col-form-label text-md-right font-weight-bold">Apellidos Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="Edita_U_apellidos" id="Edita_U_apellidos" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-Edita_U_apellidos" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="Edita_U_correo" class="col-md-4 col-form-label text-md-right font-weight-bold">Correo Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="Edita_U_correo" id="Edita_U_correo" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-Edita_U_correo" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Edita_ID_area" class="col-md-4 col-form-label text-md-right font-weight-bold">Area Usuario</label>
                                <div class="col-md-6">
                                    <select type="select" name="Edita_ID_area" id="Edita_ID_area" class="form-control chosen">
                                        <option value="">Seleccione</option>
                                        @foreach($area as $id => $nombre)
                                            <option value="{{ $id }}" >{{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback">
                                        <strong id="error-Edita_ID_area" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Edita_U_nombre_usuario" class="col-md-4 col-form-label text-md-right font-weight-bold">Nombre Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="Edita_U_nombre_usuario" id="Edita_U_nombre_usuario" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-Edita_U_nombre_usuario" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Edita_U_contrasena" class="col-md-4 col-form-label text-md-right font-weight-bold">Contraseña Usuario</label>
                                <div class="col-md-6">
                                    <input type="password" name="Edita_U_contrasena" id="Edita_U_contrasena" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-Edita_U_contrasena" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Edita_ID_tipo_usuario" class="col-md-4 col-form-label text-md-right font-weight-bold">Tipo Usuario</label>
                                <div class="col-md-6">
                                    <select type="select" name="Edita_ID_tipo_usuario" id="Edita_ID_tipo_usuario" class="form-control chosen">
                                        <option value="">Seleccione</option>
                                        @foreach($tipo_usuario as $id => $nombre)
                                            <option value="{{ $id }}" >{{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback">
                                        <strong id="error-Edita_ID_tipo_usuario" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Edita_U_descripcion" class="col-md-4 col-form-label text-md-right font-weight-bold">Descripcion</label>
                                <div class="col-md-6">
                                    <textarea type="text" name="Edita_U_descripcion" id="Edita_U_descripcion" class="form-control"></textarea>
                                    <span class="invalid-feedback">
                                        <strong id="error-Edita_U_descripcion" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="accesos" class="col-md-4 col-form-label text-md-right font-weight-bold">Accesos</label>
                                <div class="col-md-6">
                                    <div class="accordion" id="accesos">
                                        @foreach($menus as $menu)
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#{{ trim($menu->M_nombre) }}" aria-expanded="true" aria-controls="{{ trim($menu->M_nombre) }}">
                                                        {{ trim($menu->M_nombre) }}
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="{{ trim($menu->M_nombre) }}" class="collapse" aria-labelledby="headingOne" data-parent="#accesos">
                                                <div class="card-body">
                                                    @foreach($menu->submenus as $submenu)
                                                    <div class="btn-group-toggle" data-toggle="buttons">
                                                        <label id="lbl-btn-Edita_submenu{{$submenu->ID_submenu}}" class="btn btn-light check-submenus">
                                                            <input class="Edita_submenus" type="checkbox" name="Edita_submenus[]" value="{{ $submenu->ID_submenu }}" autocomplete="off">
                                                        {{ $submenu->SM_nombre }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach                                 
                                    </div>
                                </div>
                            </div>

                            

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_editar_usuario" class="btn btn-warning btn-lg btn-block">
                                        Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>