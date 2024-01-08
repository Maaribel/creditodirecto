<style type="text/css">
    td {
        padding: 10px 10px 10px 10px;
        border: 1px solid;
        border-collapse: collapse; 
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
    }

    th {
        padding: 10px 10px 10px 10px;
        border: 1px solid;
        border-collapse: collapse; 
        font-family: Arial, Helvetica, sans-serif;
    }

    table {
         border: 1px solid;
         border-collapse: collapse; 
         width:100% ;
    }

    td#titulo {
        color: black;
        width: 300px;

    }

    td#cont {
        font-weight: bold;
        font-size: 18px;
    }

</style>

<table>
    <thead>
        <tr>
            <th><img src="{{ asset('img/Logo_Surte.png') }}" width="150px"></th>
            <th>AGRÍCOLA Y GANADERA LOS PINOS</th>
            <th>{{  \Carbon\Carbon::now()->format('d-m-Y H:i:s'); }}</th>
        </tr>
    </thead>
</table>
<br>    
<table>
    <thead>
        <tr>
            <th colspan="2">
                <h1 style="width:100% ; font-family: Arial, Helvetica, sans-serif;">CUADRO DE PAGOS</h1>
            </th>
        </tr>
    </thead>
</table>
<br>
<table>
    <thead>
    	<tr>
            <th colspan="2">CLIENTE: {{ $cuadroP->cliente->CL_nombre }}</th>
            <th>RUT: {{ $cuadroP->cliente->CL_rut }}</th>
        </tr>
        <tr>
            <th>PARCELA: {{ $cuadroP->PC_nombre }}</th>
            <th colspan="2">FECHA INICIO CRÉDITO: {{  \Carbon\Carbon::parse($cuadroP->PC_inicio_credito)->format('d-m-Y'); }}</th>
        </tr>
        <tr>
            <th>TOTAL CUOTAS: {{ $cuadroP->parcela_cuotas->count(); }}</th>
            <th>CUOTAS PAGADAS: {{ $cuadroP->parcela_cuotas_pagadas->count(); }}</th>
            <th>CUOTAS MOROSAS: {{ $cuadroP->parcela_cuotas_morosas->count(); }}</th>
        </tr>
    </thead>
</table>
<br>
<table>
    <thead>
        <tr>
            <th>NRO CUOTA</th>
            <th>FECHA VENCIMIENTO</th>
            <th>CUOTA</th>
            <th>ESTADO CUOTA</th>
            <th>FECHA PAGO</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cuadroP->parcela_cuotas as $cuotas)
        <tr>
            <td>{{ $cuotas->CT_nro_cuota }}</td>
            <td>{{  \Carbon\Carbon::parse($cuotas->CT_fecha_vencimiento)->format('d-m-Y'); }}</td>
            <td>$ {{ number_format($cuotas->CT_valor_cuota,0,",","."); }}</td>
            <td>{{ $cuotas->estado_cuota->ECT_nombre }}</td>
            <td>{{ (($cuotas->CT_fecha_pago == NULL) ? ' - ' : \Carbon\Carbon::parse($cuotas->CT_fecha_pago)->format('d-m-Y')); }}</td>
        </tr>
        @endforeach
    </tbody>
</table>