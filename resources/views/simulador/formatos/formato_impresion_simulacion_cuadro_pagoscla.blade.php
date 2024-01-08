<style type="text/css">
    td {
        padding: 6px 6px 6px 6px;
        border: 1px solid;
        border-collapse: collapse; 
        font-family: Arial, Helvetica, sans-serif;
    }

    th {
        padding: 8px 8px 8px 8px;
        border: 1px solid;
        border-collapse: collapse; 
        font-family: Arial, Helvetica, sans-serif;
    }

    table {
         border: 1px solid;
         border-collapse: collapse; 
         width:100% ;
    }

    td#titulo_sm {
        color: black;
        width: 300px;

    }

    td#cont_sm {
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
                <h1 style="width:100% ; font-family: Arial, Helvetica, sans-serif;">SIMULACI&Oacute;N CUADRO DE PAGOS</h1>
            </th>
        </tr>
    </thead>
</table>
<br>
<table>
    <tbody>
        <tr>
            <td colspan="4">PROYECTO:  {{ $simulacionccla->SCLA_nom_proyecto}}</td>
        </tr>
        <tr>
            <td colspan="2">PARCELA:  {{ $simulacionccla->SCLA_nom_parcela }}</td>
            <td colspan="2">CLIENTE: {{ $simulacionccla->SCLA_nom_cliente}}</td>
        </tr>
        <tr>
            <td colspan="4">MONTO PR&Eacute;STAMO: ${{ number_format($simulacionccla->SCLA_cupo_otorgado,0,",","."); }}</td>
        </tr>
        <tr>
            <td colspan="2">CUOTAS: {{ $simulacionccla->SCLA_cantidad_cheques }}</td>
            <td colspan="2">VALOR CUOTA: ${{ number_format($simulacionccla->SCLA_valor_cuota,0,",","."); }}</td>
        </tr>
        <tr>
            <td colspan="2">TASA ANUAL: {{ $simulacionccla->SCLA_tasa_anual }}%</td>
            <td colspan="2">TOTAL: ${{ number_format($simulacionccla->SCLA_valor_cuota*$simulacionccla->SCLA_cantidad_cheques,0,",","."); }}</td>
        </tr>
        <tr>
            <td colspan="2">TASA MENSUAL: {{ number_format($simulacionccla->SCLA_tasa_mensual,2,",",".") }}%</td>
            <td colspan="2">COSTO: ${{ number_format(($simulacionccla->SCLA_valor_cuota*$simulacionccla->SCLA_cantidad_cheques)-$simulacionccla->SCLA_cupo_otorgado,0,",","."); }}</td>
        </tr>
    </tbody>
</table>

<br>
<table>
    <thead>
        <tr>
            <th>N° CUOTA</th>
            <th>VENCIMIENTO</th>
            <th>VALOR CUOTA</th>
            <th>CAPITAL</th>
            <th>INTERESES</th>
            <th>SALDO</th>
        </tr>
    </thead>
    <tbody>
        @foreach($simulacionccla->simuladorcla_cuotascla as $cuotascla)
        <tr>
            <td style="text-align: center;">{{ $cuotascla->CCLA_nro_cuota }}</td>
            <td style="text-align: center;">{{  \Carbon\Carbon::parse($cuotascla->CCLA_fecha_vencimiento)->format('d-m-Y'); }}</td>
            <td style="text-align: center;">$ {{ number_format($cuotascla->CCLA_valor_cuota,0,",","."); }}</td>
            <td style="text-align: center;">$ {{ number_format($cuotascla->CCLA_capital,0,",","."); }}</td>
            <td style="text-align: center;">$ {{ number_format($cuotascla->CCLA_interes,0,",","."); }}</td>
            <td style="text-align: center;">$ {{ number_format($cuotascla->CCLA_saldo,0,",","."); }}</td>
        </tr>
        @endforeach
    </tbody>
</table>