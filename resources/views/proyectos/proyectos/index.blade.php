@extends('layouts.app_admin')

@section('content_admin')
@include('proyectos.proyectos.mdl-nuevo-proyecto')
@include('proyectos.proyectos.mdl-edita-proyecto')
@include('proyectos.proyectos.mdl-flujo-proyecto')
@include('proyectos.parcelas.mdl-parcelas')
@include('proyectos.parcelas.mdl-edita-parcelas')
@include('proyectos.parcelas.mdl-resumen-parcelas')
@include('proyectos.parcelas.mdl-cuadro-pagos')
@include('proyectos.parcelas.mdl-edita-cuadro-pagos')
@include('proyectos.cheques.mdl-cheques')
@include('proyectos.cheques.mdl-edita-cheques')
@include('proyectos.transferencias.mdl-transferencias')
@include('proyectos.transferencias.mdl-edita-transferencias')

<div class=" ">
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Parque los esteros</h1>
                </div>
                <div class="card-body">
                    <div class="row">

                   @if(Auth::user()->ID_tipo_usuario != 3)
                   <div class="col-md-9">  
                        <div class="btn-group">
                            <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#mdl-nuevo-proyecto"><i class='fas fa-plus'></i> Nueva Etapa</button>
                        </div>
                    @else

                    @endif
                    </div>
                    <div class="col-md-3">
                        <div class="btn-group" align="right">
                            <a href="{{ route('export_parcelas_ple') }}" class="btn btn-success btn-lg"><i class='fas fa-arrow-down'></i> Exportar Parcelas a Excel</a>
                        </div>

                    </div>
                      </div>
                   <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable_desc">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">#</th>
                                    <th style="width: 100px;">Nombre</th>
                                    <th style="width: 60px;">Parcelas</th>
                                    <th style="width: 60px;">Fecha Inicio Ventas</th>
                                    <th style="width: 60px;">Total Unidades</th>
                                    <th style="width: 60px;">Creador</th>
                                    <th style="width: 40px;">Registros</th>
                                    <th style="width: 60px;">Estado</th>
                                    <th style="width: 90px;">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proyectos as $pr)
                                    <tr>
                                        <td>{{ $pr->ID_proyecto }}</td>
                                        <td>{{ $pr->PR_nombre }}</td>   
                                        <td><button class="btn btn-info btn_parcela"  value="{{ $pr->ID_proyecto }}"><i class='fas fa-eye'></i> Ver Parcelas</button></td>
                                        <td>{{ \Carbon\Carbon::parse($pr->PR_fecha_inicio_ventas)->format('d-m-Y') }}</td> 
                                        <td>{{ $pr->PR_total_unidades }}</td> 
                                        <td>{{ $pr->usuariocrea->U_nombres }} {{ $pr->usuariocrea->U_apellidos }}</td>
                                        <td><strong>Creación: </strong><br>{{ \Carbon\Carbon::parse($pr->PR_fecha_creacion)->format('d-m-Y') }}
                                        <strong>Actualización: </strong><br>{{ \Carbon\Carbon::parse($pr->PR_fecha_actualizacion)->format('d-m-Y ') }}</td>
                                        <td>{{ $pr->estado->E_nombre }}</td>
                                        <td align="center">
                                            <div class="btn-group-vertical">
                                                @if($pr->proy_parcela->count() >= 1)
                                                    <button class="btn btn-primary btn_flujo_proyecto"  value="{{ $pr->ID_proyecto }}"><i class='fas fa-eye'></i> Flujo</button>
                                                @else

                                                @endif

                                                @if(Auth::user()->ID_tipo_usuario != 3)
                                                    <button class="btn btn-warning btn_edita_proyecto"  value="{{ $pr->ID_proyecto }}"><i class='fas fa-edit'></i> Editar</button>
                                                    <button class="btn btn-danger btn_ocultar_proyecto" value="{{ $pr->ID_proyecto }}"><i class='fas fa-times'></i> Ocultar</button>
                                                @else

                                                @endif
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
