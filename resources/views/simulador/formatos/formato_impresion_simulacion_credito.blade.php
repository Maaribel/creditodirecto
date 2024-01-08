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
                <h1 style="width:100% ; font-family: Arial, Helvetica, sans-serif;">SIMULACIÓN CRÉDITO</h1>
            </th>
        </tr>
    </thead>
</table>
<br>

<table>
    <tbody>
        <tr>
            <td id="titulo_sm">PROYECTO</td>
            <td  id="cont_sm">{{ $simulacion->tasa_anual->TA_nom_proyecto }}</td>
        </tr>
        <tr>
            <td id="titulo_sm">NOMBRE PARCELA</td>
            <td  id="cont_sm">{{ $simulacion->S_nom_parcela }}</td>
        </tr>
    	<tr>
            <td id="titulo_sm">CLIENTE</td>
            <td  id="cont_sm">{{ $simulacion->S_nombre_cliente }}</td>
        </tr>
        <tr>
            <td id="titulo_sm">VALOR PARCELA</td>
            <td  id="cont_sm"> $ {{  number_format($simulacion->S_valor_parcela,0,",","."); }}</td>
        </tr>
        <tr>
            <td id="titulo_sm">RESERVA</td>
            <td id="cont_sm"> $ {{  number_format($simulacion->S_reserva,0,",","."); }}</td>
        </tr>
        <tr>
            <td  id="titulo_sm">PIE</td>
            <td id="cont_sm"> $ {{  number_format($simulacion->S_pie,0,",","."); }}</td>
        </tr>
        <tr>
            <td id="titulo_sm">COMPRAVENTA</td>
            <td id="cont_sm"> $ {{  number_format($simulacion->S_compraventa,0,",","."); }}</td>
        </tr>
             <tr>
                <td id="titulo_sm">FECHA INICIO CRÉDITO</td>
                <td id="cont_sm"> {{  \Carbon\Carbon::parse($simulacion->S_fecha_inicio_credito)->format('d-m-Y'); }}</td>
            </tr>
            <tr>
                <td id="titulo_sm">CUPO OTORGADO</td>
                <td id="cont_sm"> $ {{  number_format($simulacion->S_cupo_otorgado,0,",","."); }}</td>
            </tr>
            <tr>
                <td id="titulo_sm">TASA INTERÉS ANUAL</td>
                <td id="cont_sm"> {{  $simulacion->tasa_anual->TA_tasa_anual }}%</td>
            </tr>
            <tr>
                <td id="titulo_sm">CANTIDAD DE CUOTAS</td>
                <td id="cont_sm"> {{  $simulacion->S_cantidad_cheques }}</td>
            </tr>
            <tr>
                <td id="titulo_sm">FECHA ÚLTIMA CUOTA</td>
                <td id="cont_sm"> {{  \Carbon\Carbon::parse($simulacion->S_fecha_ultima_cuota)->format('d-m-Y'); }}</td>
            </tr>
            <tr>
                <td id="titulo_sm">VALOR CUOTA FIJA</td>
                <td id="cont_sm">$ {{  number_format($simulacion->S_valor_cuota,0,",","."); }}</td>
            </tr>
    </tbody>
</table>