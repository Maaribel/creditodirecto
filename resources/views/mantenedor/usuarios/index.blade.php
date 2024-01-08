@extends('layouts.app_admin')

@section('content_admin')

@include('mantenedor.usuarios.mdl-nuevo-usuario')
@include('mantenedor.usuarios.mdl-edita-usuario')

<div class="">
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Lista de usuarios</h1>
                </div>
                <div class="card-body">
                    <div class="btn-group">
                        <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#mdl-nuevo-usuario"><i class='fas fa-plus'></i> Agregar Usuario</button>
                    </div>
                   <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Rut</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th class="text-nowrap">Nombre Usuario</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Creado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->ID_usuario }}</td>
                                        <td class="text-nowrap">{{ $usuario->U_rut }}</td>
                                        <td class="text-nowrap">{{ $usuario->U_nombres }} {{ $usuario->U_apellidos }}</td>
                                        <td>{{ $usuario->U_correo }}</td>
                                        <td>{{ $usuario->U_nombre_usuario }}</td>
                                        <td class="text-nowrap">{{ $usuario->tipo_usuario->TU_nombre }}</td>
                                        <td>{{ $usuario->estado_us->E_nombre }}</td>
                                        <td class="text-nowrap">{{ \Carbon\Carbon::parse($usuario->U_fecha_creacion)->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="btn-group-vertical">
                                                <button class="btn btn-warning" id="btn_edita_usuario" value="{{ $usuario->ID_usuario }}"><i class="fa fa-edit"></i> 
                                                   Editar
                                                </button>
                                                <button class="btn btn-danger btn-ocultar-usuario" value="{{ $usuario->ID_usuario }}"> <i class="fa fa-times"></i> 
                                                   Ocultar
                                                </button>
                                                <button class="btn btn-primary btn-restart-password-usuario" value="{{ $usuario->ID_usuario }}"><i class="fa fa-unlock"></i> Contraseña
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
