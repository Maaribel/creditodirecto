@extends('layouts.app_admin')

@section('content_admin')

@include('mantenedor.tasa_anual.mdl-nueva-tasa-anual')
@include('mantenedor.tasa_anual.mdl-edita-tasa-anual')

<div class="">
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>TASAS ANUALES</h1>
                </div>
                <div class="card-body">
                    <div class="btn-group">
                        <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#mdl-nueva-tasa-anual"><i class='fas fa-plus'></i> Agregar Tasa Anual</button>
                    </div>
                   <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Etapa</th>
                                    <th>Tasa Anual</th>
                                    <th>Creado</th>
                                    <th>Actualizado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasa_anual as $tasa)
                                    <tr>
                                        <td>{{ $tasa->ID_tasa_anual }}</td>
                                        <td>{{ $tasa->TA_nom_proyecto }}</td>
                                        <td>{{ $tasa->TA_tasa_anual }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tasa->TA_fecha_creacion)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tasa->TA_fecha_actualizacion)->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="btn-group-vertical">
                                                <button class="btn btn-warning btn_edita_tasa_anual"  value="{{ $tasa->ID_tasa_anual }}"><i class="fa fa-edit"></i> Editar</button>
                                                <button class="btn btn-danger btn_ocultar_tasa_anual" value="{{ $tasa->ID_tasa_anual }}"> <i class="fa fa-times"></i> Ocultar</button>
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
