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
                <h1 style="width:100% ; font-family: Arial, Helvetica, sans-serif;">SIMULACIÓN CUADRO DE PAGOS</h1>
            </th>
        </tr>
    </thead>
</table>
<br>
<table>
    <tbody>
        <tr>
            <td colspan="4">PROYECTO:  {{ $simulacionc->tasa_anual->TA_nom_proyecto}}</td>
        </tr>
        <tr>
            <td colspan="2">PARCELA:  {{ $simulacionc->S_nom_parcela }}</td>
            <td colspan="2">CLIENTE: {{ $simulacionc->S_nombre_cliente}}</td>
        </tr>
        <tr>
            <td colspan="4">MONTO PRÉSTAMO: ${{ number_format($simulacionc->S_cupo_otorgado,0,",","."); }}</td>
        </tr>
        <tr>
            <td colspan="2">CUOTAS: {{ $simulacionc->S_cantidad_cheques }}</td>
            <td colspan="2">VALOR ACTUAL: ${{ number_format($simulacionc->S_valor_cuota,0,",","."); }}</td>
        </tr>
        <tr>
            <td colspan="2">TASA ANUAL: {{ $simulacionc->tasa_anual->TA_tasa_anual }}%</td>
            <td colspan="2">TOTAL: ${{ number_format($simulacionc->S_valor_cuota*$simulacionc->S_cantidad_cheques,0,",","."); }}</td>
        </tr>
        <tr>
            <td colspan="2">TASA MENSUAL: {{ $simulacionc->S_tasa_mensual }}%</td>
            <td colspan="2">COSTO: ${{ number_format(($simulacionc->S_valor_cuota*$simulacionc->S_cantidad_cheques)-$simulacionc->S_cupo_otorgado,0,",","."); }}</td>
        </tr>
        <tr>
            <td>NRO CUOTA:  0</td>
            <td>CAPITAL: ${{ number_format($simulacionc->S_cupo_otorgado,0,",","."); }}</td>
            <td>INTERÉS: ${{ number_format($simulacionc->S_interes,0,",","."); }}</td>
            <td>SALDO:  ${{ number_format($simulacionc->S_saldo,0,",","."); }}</td>
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
        @foreach($simulacionc->simulador_cuotas as $cuotas)
        <tr>
            <td style="text-align: center;">{{ $cuotas->CTS_nro_cuota }}</td>
            <td style="text-align: center;">{{  \Carbon\Carbon::parse($cuotas->CTS_fecha_vencimiento)->format('d-m-Y'); }}</td>
            <td style="text-align: center;">$ {{ number_format($cuotas->CTS_valor_cuota,0,",","."); }}</td>
            <td style="text-align: center;">$ {{ number_format($cuotas->CTS_capital,0,",","."); }}</td>
            <td style="text-align: center;">$ {{ number_format($cuotas->CTS_interes,0,",","."); }}</td>
            <td style="text-align: center;">$ {{ number_format($cuotas->CTS_saldo,0,",","."); }}</td>
        </tr>
        @endforeach
    </tbody>
</table>