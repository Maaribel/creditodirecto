<div id="mdl-nuevo-usuario" class="modal fade"tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header alert-dark">   
                        <div class="text-center">
                            <h1>Nuevo Usuario</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="frm-nuevo-usuario">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group row">
                                <label for="U_rut" class="col-md-4 col-form-label text-md-right font-weight-bold">Rut Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="U_rut" id="U_rut" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-U_rut" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="U_nombres" class="col-md-4 col-form-label text-md-right font-weight-bold">Nombres Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="U_nombres" id="U_nombres" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-U_nombres" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="U_apellidos" class="col-md-4 col-form-label text-md-right font-weight-bold">Apellidos Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="U_apellidos" id="U_apellidos" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-U_apellidos" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="U_correo" class="col-md-4 col-form-label text-md-right font-weight-bold">Correo Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="U_correo" id="U_correo" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-U_correo" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="ID_area" class="col-md-4 col-form-label text-md-right font-weight-bold">Area Usuario</label>
                                <div class="col-md-6">
                                    <select type="select" name="ID_area" id="ID_area" class="form-control chosen">
                                        <option value="">Seleccione</option>
                                        @foreach($area as $id => $nombre)
                                            <option value="{{ $id }}">{{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback">
                                        <strong id="error-ID_area" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="U_nombre_usuario" class="col-md-4 col-form-label text-md-right font-weight-bold">Nombre Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="U_nombre_usuario" id="U_nombre_usuario" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong id="error-U_nombre_usuario" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ID_tipo_usuario" class="col-md-4 col-form-label text-md-right font-weight-bold">Tipo Usuario</label>
                                <div class="col-md-6">
                                    <select type="select" name="ID_tipo_usuario" id="ID_tipo_usuario" class="form-control chosen">
                                        <option value="">Seleccione</option>
                                        @foreach($tipo_usuario as $id => $nombre)
                                            <option value="{{ $id }}">{{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback">
                                        <strong id="error-ID_tipo_usuario" class='strong-default'></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="U_descripcion" class="col-md-4 col-form-label text-md-right font-weight-bold">Descripcion Usuario</label>
                                <div class="col-md-6">
                                    <textarea type="text" name="U_descripcion" id="U_descripcion" class="form-control"></textarea>
                                    <span class="invalid-feedback">
                                        <strong id="error-U_descripcion" class='strong-default'></strong>
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
                                                        <label id="lbl-btn-submenu{{$submenu->ID_submenu}}" class="btn btn-light check-submenus">
                                                            <input class="sub-menus" type="checkbox" name="submenus[]" value="{{ $submenu->ID_Submenu }}" autocomplete="off">
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
                                    <button type="submit" id="btn_nuevo_usuario" class="btn btn-dark btn-lg btn-block">
                                       Nuevo Usuario
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>