<style type="text/css">
    td {
        padding: 4px 4px 4px 4px;
        border: 1px solid;
        border-collapse: collapse; 
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
    }

    th {
        padding: 6px 6px 6px 6px;
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
            <th>AGR&Iacute;COLA Y GANADERA LOS PINOS</th>
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
            <td colspan="3"><h2>PARCELA:  {{ $simulacioncldm->parcelasldm->PLM_nombre }}</h2></td>
        </tr>
        <tr>
            <td><p>VALOR LISTA: UF {{ number_format($simulacioncldm->parcelasldm->PLM_valor_lista,0,",",".") }}.-</p></td>
            <td>DCTO OTORGADO:  {{ number_format($simulacioncldm->parcelasldm->PLM_descuento,1,",",".") }} %</td>
            <td>VALOR VENTA: UF {{ number_format($simulacioncldm->parcelasldm->PLM_valor_venta,0,",",".") }}.-</td>
        </tr>
        <tr>
            @if($simulacioncldm->SLM_tipo_credito == 1)
                <td>CONDICIONES DEL CR&Eacute;DITO: </td>
                <td colspan="2">CR&Eacute;DITO TRADICIONAL</td>
            @else
                <td>CONDICIONES DEL CR&Eacute;DITO: </td>
                <td colspan="2">CR&Eacute;DITO CUOTA LIVIANA</td>
            @endif
        </tr>
        <tr>
            <td>PIE SOLICITADO: {{ number_format($simulacioncldm->SLM_pie_solicitado,0,",",".") }} %</td>
            <td>TASA ANUAL: {{ number_format($simulacioncldm->SLM_interes_anual ,1,",",".") }} %</td>
            <td>CUOTAS: {{ $simulacioncldm->numcuotassldm->NC_cuotas }}</td>
        </tr>
        @if($simulacioncldm->SLM_tipo_credito == 2)
        <tr>
            <td>CUOTA FINAL: {{  number_format($simulacioncldm->SLM_cuota_final,1,",","."); }} %</td>
            <td>MONTO CUOTA FINAL:  UF {{  number_format($simulacioncldm->SLM_monto_cuota_final,0,",","."); }}.-</td>
            <td></td>
        </tr>
        @else
        @endif
        <tr>
            <td>MONTO PIE: UF {{ number_format($simulacioncldm->SLM_monto_pie,1,",",".") }}.-</td>
            <td>TASA MENSUAL: {{ number_format($simulacioncldm->SLM_interes_mensual*100,2,",",".") }} %</td>
            <td></td>
        </tr>
        <tr>
            <td>MONTO A FINANCIAR: UF {{ number_format($simulacioncldm->SLM_cupo_otorgado,1,",",".") }}.-</td>
            <td>CUOTA FIJA: UF {{ number_format($simulacioncldm->SLM_valor_cuota,1,",",".") }}.-</td>
            <td>VALOR FINAL CR&Eacute;DITO: UF {{ number_format($simulacioncldm->SLM_monto_pie+$simulacioncldm->SLM_monto_cuota_final+$simulacioncldm->SLM_valor_cuota*$simulacioncldm->numcuotassldm->NC_cuotas,2,",",".") }}.-</td>
        </tr>
    </tbody>
</table>

<br>
<table>
    <thead>
        <tr>
            <th>N° CUOTA</th>
            <th>VENCIMIENTO</th>
            <th>SALDO INICIAL</th>
            <th>CUOTA FIJA</th>
            <th>INTERESES</th>
            <th>ABONO CAPITAL</th>
            <th>SALDO CAPITAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($simulacioncldm->simuladorldm_cuotasldm as $cuotas)
        <tr>
            <td style="text-align: center;">{{ $cuotas->SCLM_nro_cuota }}</td>
            <td style="text-align: center;">{{  \Carbon\Carbon::parse($cuotas->SCLM_fecha_vencimiento)->format('d-m-Y'); }}</td>
            <td style="text-align: center;">UF {{ number_format($cuotas->SCLM_saldo_ini,2,",","."); }}.-</td>
            <td style="text-align: center;">UF {{ number_format($cuotas->SCLM_valor_cuota,2,",","."); }}.-</td>
            <td style="text-align: center;">UF {{ number_format($cuotas->SCLM_abono,2,",","."); }}.-</td>
            <td style="text-align: center;">UF {{ number_format($cuotas->SCLM_interes,2,",","."); }}.-</td>
            <td style="text-align: center;">UF {{ number_format($cuotas->SCLM_capital,2,",","."); }}.-</td>
        </tr>
        @endforeach
    </tbody>
</table>