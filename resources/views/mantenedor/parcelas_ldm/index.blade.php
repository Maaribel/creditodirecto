@extends('layouts.app_admin')

@section('content_admin')
@include('mantenedor.parcelas_ldm.mdl-nueva-parcela-ldm')
@include('mantenedor.parcelas_ldm.mdl-edita-parcela-ldm')

<div class="">
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>PARCELAS LDM</h1>
                </div>
                <div class="card-body">
                    <div class="btn-group">
                        <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#mdl-nueva-parcela-ldm"><i class='fas fa-plus'></i> Agregar Parcela</button>
                    </div>
                   <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Valor Lista</th>
                                    <th>Descuento</th>
                                    <th>Valor Venta</th>
                                    <th>Creado</th>
                                    <th>Actualizado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parcelasLDM as $pldm)
                                    <tr align="center">
                                        <td>{{ $pldm->ID_parcelas_lista_ldm }}</td>
                                        <td class="font-weight-bold">{{ $pldm->PLM_nombre }}</td>
                                        <td>{{ number_format($pldm->PLM_valor_lista,0,",",".") }}</td>
                                        <td>{{ number_format($pldm->PLM_descuento,1,",",".") }}</td>
                                        <td>{{ number_format($pldm->PLM_valor_venta,2,",",".") }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pldm->PLM_fecha_creacion)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pldm->PLM_fecha_actualizacion)->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-warning btn_editar_parcela_ldm"  value="{{ $pldm->ID_parcelas_lista_ldm }}"><i class="fa fa-edit"></i> Editar</button>
                                                <button class="btn btn-danger btn_ocultar_parcela_ldm" value="{{ $pldm->ID_parcelas_lista_ldm }}"> <i class="fa fa-times"></i> Ocultar</button>
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
