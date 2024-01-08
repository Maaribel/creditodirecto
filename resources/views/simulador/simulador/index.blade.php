@extends('layouts.app_admin')

@section('content_admin')

@include('simulador.simulador.mdl-nueva-simulacion')
@include('simulador.simulador.mdl-edita-simulacion')
@include('simulador.simulador.mdl-cuadro-pagos-simulacion')

<div class=" ">
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>SIMULADOR PLE</h1>
                </div>
                <div class="card-body">
                  
                    <div class="btn-group">
                        <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#mdl-nueva-simulacion"><i class='fas fa-plus'></i> Nueva Simulación</button>
                    </div>
             
                   <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable_desc">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">#</th>
                                    <th style="width: 100px;">Proyecto</th>
                                    <th style="width: 60px;">Cliente</th>
                                    <th style="width: 60px;">Cuotas</th>
                                    <th style="width: 60px;">Creador</th>
                                    <th style="width: 40px;">Creacion</th>
                                    <th style="width: 90px;">Opciones</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($simulador as $sim)
                                    <tr>
                                        <td>{{ $sim->ID_simulador}}</td>
                                        <td>{{ $sim->tasa_anual->TA_nom_proyecto }}</td>   
                                        <td>{{ $sim->S_nombre_cliente }}</td>
                                        <td><button class="btn btn-link btn_cuotas_sim font-weight-bold"  value="{{ $sim->ID_simulador }}">{{ $sim->S_cantidad_cheques }}</button></td>
                                        <td>{{ $sim->usuariocrea->U_nombres }} {{ $sim->usuariocrea->U_apellidos }}</td>
                                        <td>{{ \Carbon\Carbon::parse($sim->S_fecha_creacion)->format('d-m-Y H:i:s') }}
                                    </td>
                                        <td align="center">
                                            <div class="btn-group">
                                                @if(Auth::user()->ID_tipo_usuario == 1)
                                                    <button class="btn btn-warning btn_edita_simulador"  value="{{ $sim->ID_simulador }}" style="display:none;"><i class='fas fa-edit'></i> Editar</button>
                                                @else

                                                @endif 
                                                <a class="btn btn-primary" href="{{ route('get_print_simulacion', ['sim' => $sim->ID_simulador])}}"><i class="fas fa-download"> </i> Simple</a>
                                                <button class="btn btn-danger btn_eliminar_simulador"  value="{{ $sim->ID_simulador }}"><i class='fas fa-times'></i> Eliminar</button>
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
