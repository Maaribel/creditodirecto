@extends('layouts.app_admin')

@section('content_admin')

<div class="">
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Historial de sesiones</h1>
                </div>
                <div class="card-body">
                    
                   <div class="table-responsive">
                        <table class="table table-bordered datatable_desc">
                            <thead>
                                <tr>
                                    <th width="50px">#</th>
                                    <th width="90px">ID usuario</th>
                                    <th width="150px">Usuario</th>
                                    <th width="150px">Nombre Usuario</th>
                                    <th>&Uacute;ltima Sesi&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($historials as $his)
                                    <tr>
                                        <td>{{ $his->ID_historial_sesiones }}</td>
                                        <td>{{ $his->ID_usuario }}</td>
                                        <td class="text-nowrap">{{ $his->usuario->U_nombres }} {{ $his->usuario->U_apellidos }}</td>
                                        <td class="text-nowrap">{{ $his->usuario->U_nombre_usuario }}</td>
                                        <td class="text-nowrap">{{ \Carbon\Carbon::parse($his->HS_fecha_conexion)->format('d-m-Y ') }}<br><p>{{ \Carbon\Carbon::parse($his->HS_fecha_conexion)->diffForHumans() }}</p></td>
                            
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
