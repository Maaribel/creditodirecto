<style type="text/css">
    td {
        padding: 10px 10px 10px 10px;
        border: 1px solid;
        border-collapse: collapse; 
        font-family: Arial, Helvetica, sans-serif;
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

    td#titulo_sm {
        color: black;
        width: 300px;

    }

    td#cont_sm {
        font-weight: bold;
        font-size: 18px;
        white-space: pre-line;
    }

    label#contlb_sm{
        font-weight: bold;
        font-size: 18px;
        white-space: pre-line;
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
                <h1 style="width:100% ; font-family: Arial, Helvetica, sans-serif;">SIMULACI&Oacute;N CR&Eacute;DITO LDM</h1>
            </th>
        </tr>
    </thead>
</table>
<br>

<table>
    <tbody>
        <tr>
            <td id="titulo_sm">NOMBRE PARCELA:</td>
            <td  id="cont_sm">{{ $simulacionldm->parcelasldm->PLM_nombre }}</td>
        </tr>
    	<tr>
            <td id="titulo_sm" colspan="2">CLIENTE</td>
        </tr>
        <tr>
            <td  id="cont_sm" colspan="2">{{ $simulacionldm->SLM_datos_cliente }}</td>
        </tr>
        <tr>
            <td id="titulo_sm">VALOR PARCELA LISTA: </td>
            <td  id="cont_sm"> UF {{  number_format($simulacionldm->parcelasldm->PLM_valor_lista,0,",","."); }}.-</td>
        </tr>
        <tr>
            <td id="titulo_sm">DESCUENTO OTORGADO</td>
            <td id="cont_sm"> {{  number_format($simulacionldm->parcelasldm->PLM_descuento,1,",","."); }} %</td>
        </tr>
        <tr>
            <td  id="titulo_sm">VALOR PARCELA VENTA</td>
            <td id="cont_sm"> UF {{  number_format($simulacionldm->parcelasldm->PLM_valor_venta,0,",","."); }}.-</td>
        </tr>
        <tr>
            @if($simulacionldm->SLM_tipo_credito == 2)
            <td colspan="2" id="cont_sm">CONDICIONES DEL CR&Eacute;DITO: CUOTA LIVIANA</td>
            @else
            <td colspan="2" id="cont_sm">CONDICIONES DEL CR&Eacute;DITO: TRADICIONAL</td>
            @endif
        </tr>
        <tr>
            <td id="titulo_sm">PIE SOLICITADO:</td>
            <td id="cont_sm"> {{  number_format($simulacionldm->SLM_pie_solicitado,1,",","."); }} %</td>
        </tr>
        <tr>
            <td id="titulo_sm">MONTO PIE: </td>
            <td id="cont_sm">UF {{  number_format($simulacionldm->SLM_monto_pie,0,",","."); }}.-</td>
        </tr>
        @if($simulacionldm->SLM_tipo_credito == 2)
        <tr>
            <td id="titulo_sm">CUOTA FINAL: </td>
            <td id="cont_sm">{{  number_format($simulacionldm->SLM_cuota_final,1,",","."); }} %</td>
        </tr>
        <tr>
            <td id="titulo_sm">MONTO CUOTA FINAL: </td>
            <td id="cont_sm">UF {{  number_format($simulacionldm->SLM_monto_cuota_final,0,",","."); }}.-</td>
        </tr>
         @else
        @endif

        <tr>
            <td id="titulo_sm">TASA ANUAL: </td>
            <td id="cont_sm">{{  number_format($simulacionldm->SLM_interes_anual,1,",","."); }} %</td>
        </tr>
        <tr>
            <td id="titulo_sm">TASA MENSUAL:</td>
            <td id="cont_sm">{{  number_format($simulacionldm->SLM_interes_mensual*100,2,",","."); }} %</td>
        </tr>
        <tr>
            <td id="titulo_sm">CUOTAS: </td>
            <td id="cont_sm">{{ $simulacionldm->numcuotassldm->NC_cuotas }}</td>
        </tr>
        <tr>
            <td id="titulo_sm">VALOR CUOTA FIJA: </td>
            <td id="cont_sm">UF {{  number_format($simulacionldm->SLM_valor_cuota,2,",","."); }}.-</td>
        </tr>
        <tr>
            <td id="titulo_sm">MONTO A FINANCIAR: </td>
            <td id="cont_sm">UF {{  number_format($simulacionldm->SLM_cupo_otorgado,2,",","."); }}.-</td>
        </tr>
        <tr>
            <td id="titulo_sm">VALOR TOTAL CR&Eacute;DITO:</td>
            <td id="cont_sm">UF {{  number_format($simulacionldm->SLM_monto_pie+$simulacionldm->SLM_monto_cuota_final+$simulacionldm->SLM_valor_cuota*$simulacionldm->numcuotassldm->NC_cuotas,2,",","."); }}.-</td>
        </tr>
        
    </tbody>
</table>