@extends('layouts.app_admin')

@section('content_admin')
@include('proyectos.clientes.mdl-nuevo-cliente')
@include('proyectos.clientes.mdl-edita-cliente')
@include('proyectos.doc_clientes.mdl-doc-clientes')
@include('proyectos.doc_clientes.mdl-edita-doc-clientes')

<div class="">
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Clientes</h1>
                </div>
                <div class="card-body">
                     @if(Auth::user()->ID_tipo_usuario != 3)
                        <div class="btn-group">
                            <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#mdl-nuevo-cliente"><i class='fas fa-plus'></i> Nuevo Cliente</button>
                         </div> 
                        <hr>    
                    @else

                    @endif
                                  
                    <div class="table-responsive">
                        <table class="table table-bordered datatable_desc">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">#</th>
                                    <th style="width: 100px;">Nombre</th>
                                    <th style="width: 60px;">Rut</th>
                                    <th style="width: 60px;">Info</th>
                                    <th style="width: 60px;">Creador</th>
                                    <th style="width: 60px;">Registro</th>
                                    <th style="width: 60px;">Estado</th>
                                    <th style="width: 90px;">Opciones</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($clientes as $cli)
                                    <tr>
                                        <td>{{ $cli->ID_cliente }}</td>
                                        <td>{{ $cli->CL_nombre }}</td>
                                        <td>{{ $cli->CL_rut }}</td>
                                        <td><strong>Telefono</strong><br>{{ $cli->CL_telefono }} <hr>
                                                    <strong>Correo</strong><br>{{ $cli->CL_correo }}</td>
                                        <td>{{ $cli->usuariocrea->U_nombres }} {{ $cli->usuariocrea->U_apellidos }}</td>
                                        <td><strong>Creación</strong><br>{{ \Carbon\Carbon::parse($cli->CL_fecha_creacion)->format('d-m-Y H:i:s') }}<hr>
                                                    <strong>Actualización</strong><br>{{ \Carbon\Carbon::parse($cli->CL_fecha_actualizacion)->format('d-m-Y H:i:s') }}</td>
                                        <td align="center">{{ $cli->estado->E_nombre }}</td>
                                        <td align="center">
                                             @if(Auth::user()->ID_tipo_usuario != 3)
                                                <div class="btn-group-vertical">
                                                    <button class="btn btn-secondary btn_docx"  value="{{ $cli->ID_cliente }}"><i class='fas fa-plus'></i> Documentos</button>
                                                    <button class="btn btn-warning btn_edita_cliente"  value="{{ $cli->ID_cliente }}"><i class='fas fa-edit'></i> Editar</button>
                                                    <button class="btn btn-danger btn_ocultar_cliente" value="{{ $cli->ID_cliente }}"><i class='fas fa-times'></i> Ocultar</button>
                                                </div>
                                              @else

                                            @endif
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
