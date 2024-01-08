@extends('layouts.app_admin')

@section('content_admin')

@include('simulador.simulador_ldm_uf.mdl-nueva-simulacion_ldm')
@include('simulador.simulador_ldm_uf.mdl-cuadro-pagos-simulacion-ldm')


<div class=" ">
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>SIMULADOR LDM</h1>
                </div>
                <div class="card-body">
                  
                    <div class="btn-group">
                        <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#mdl-nueva-simulacion_ldm"><i class='fas fa-plus'></i> Nueva Simulación</button>
                    </div>
             
                   <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable_desc">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">#</th>
                                    <th style="width: 60px;">Datos Cliente</th>
                                    <th style="width: 60px;">Parcela</th>
                                    <th style="width: 60px;">Cr&eacute;dito</th>
                                    <th style="width: 60px;">Cuotas</th>
                                    <th style="width: 60px;">Creador</th>
                                    <th style="width: 40px;">Creacion</th>
                                    <th style="width: 90px;">Opciones</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($simuladorldm as $sim)
                                    <tr>
                                        <td>{{ $sim->ID_simulador_ldm}}</td>   
                                        <td>{{ $sim->SLM_datos_cliente }}</td>
                                        <td>{{ $sim->parcelasldm->PLM_nombre }}</td>
                                        @if($sim->SLM_tipo_credito == 1)
                                            <td>Cr&eacute;dito Tradicional</td>
                                        @else
                                            <td>Cr&eacute;dito Cuota Liviana</td>
                                        @endif
                                        <td><button class="btn btn-link btn_cuotas_sldm font-weight-bold"  value="{{ $sim->ID_simulador_ldm }}">{{ $sim->numcuotassldm->NC_cuotas }}</button></td>
                                        <td>{{ $sim->usuariocrea->U_nombres }} {{ $sim->usuariocrea->U_apellidos }}</td>
                                        <td>{{ \Carbon\Carbon::parse($sim->SLM_fecha_creacion)->format('d-m-Y H:i:s') }}
                                    </td>
                                        <td align="center">
                                            <div class="btn-group">
                                                @if(Auth::user()->ID_tipo_usuario == 1)
                                                    <button class="btn btn-warning btn_edita_simulador"  value="{{ $sim->ID_simulador_ldm }}" style="display:none;"><i class='fas fa-edit'></i> Editar</button>
                                                @else

                                                @endif 
                                                <a class="btn btn-primary" href="{{ route('get_print_simulacion_ldm', ['sldm' => $sim->ID_simulador_ldm])}}"><i class="fas fa-download"> </i> Simple</a>
                                                <button class="btn btn-danger btn_eliminar_simuladorldm"  value="{{ $sim->ID_simulador_ldm }}"><i class='fas fa-times'></i> Eliminar</button>
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
