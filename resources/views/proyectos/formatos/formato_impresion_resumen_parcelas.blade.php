<style type="text/css">
    td {
        padding: 7px 7px 7px 7px;
        border: 1px solid;
        border-collapse: collapse; 
        font-family: Arial, Helvetica, sans-serif;
    }

    th {
        padding: 7px 7px 7px 7px;
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
                <h1 style="width:100% ; font-family: Arial, Helvetica, sans-serif;">RESUMEN PARCELAS</h1>
            </th>
        </tr>
    </thead>
</table>
<br>
<table>
    <thead>
        <tr>
            <th colspan="2">
                <h2 style="color: black; font-family: Arial, Helvetica, sans-serif;">{{ $resParcelas->PC_nombre }}</h2>
            </th>
        </tr>
    </thead>
</table>
<br>
<table>
    <tbody>
    	<tr>
            <td id="titulo">CLIENTE</td>
            <td  id="cont">{{ $resParcelas->cliente->CL_nombre }}</td>
        </tr>
        <tr>
            <td id="titulo">VALOR PARCELA</td>
            <td  id="cont"> $ {{  number_format($resParcelas->PC_valor_parcela,0,",","."); }}</td>
        </tr>
        <tr>
            <td id="titulo">RESERVA</td>
            <td id="cont"> $ {{  number_format($resParcelas->PC_reserva,0,",","."); }}</td>
        </tr>
         <tr>
            <td id="titulo">COMPRAVENTA</td>
            <td id="cont"> $ {{  number_format($resParcelas->PC_promesa,0,",","."); }}</td>
        </tr>

        @if($resParcelas->PC_forma_pago == 1)
        <tr>
            <td id="titulo">FORMA DE PAGO</td>
            <td id="cont">CREDITO DIRECTO</td>
        </tr>
        @elseif($resParcelas->PC_forma_pago == 2)
            <tr>
            <td id="titulo">FORMA DE PAGO</td>
            <td id="cont">CONTADO</td>
        </tr>
        @else
        <tr>
            <td id="titulo">FORMA DE PAGO</td>
            <td id="cont">TRANSFERENCIA MENSUAL</td>
        </tr>

        @endif

       @if($resParcelas->PC_forma_pago == 1)
            <tr>
                <td  id="titulo">PIE</td>
                <td id="cont"> $ {{  number_format($resParcelas->PC_pie,0,",","."); }}</td>
            </tr>
             <tr>
                <td id="titulo">FECHA INICIO CRÉDITO</td>
                <td id="cont"> {{  \Carbon\Carbon::parse($resParcelas->PC_inicio_credito)->format('d-m-Y'); }}</td>
            </tr>
            <tr>
                <td id="titulo">CUPO OTORGADO</td>
                <td id="cont"> $ {{  number_format($resParcelas->PC_cupo_otorgado,0,",","."); }}</td>
            </tr>
            <tr>
                <td id="titulo">TASA INTERÉS ANUAL</td>
                <td id="cont"> {{  $resParcelas->PC_tasa_anual }}%</td>
            </tr>
            <tr>
                <td id="titulo">CANTIDAD DE CHEQUES</td>
                <td id="cont"> {{  $resParcelas->PC_cant_cheques }}</td>
            </tr>
            <tr>
                <td id="titulo">FECHA ÚLTIMA CUOTA</td>
                <td id="cont"> {{  \Carbon\Carbon::parse($resParcelas->PC_fecha_ultima_cuota)->format('d-m-Y'); }}</td>
            </tr>
            <tr>
                <td id="titulo">VALOR CUOTA</td>
                <td id="cont">$ {{  number_format($resParcelas->PC_valor_cuota,0,",","."); }}</td>
            </tr>
            
            <tr>
                <td id="titulo">CUOTAS EN MORA</td>
                <td id="cont"> {{  $resParcelas->parcela_cheque_atr->count() }}</td>
            </tr>
            <tr>
                <td id="titulo">MONTO EN MORA</td>
                <td id="cont">  $ {{  number_format($resParcelas->PC_valor_cuota*$resParcelas->parcela_cheque_atr->count(),0,",","."); }}</td>
            </tr>
            <tr>
                <td id="titulo">CUOTAS PAGADAS A LA FECHA</td>
                <td id="cont"> {{  $resParcelas->parcela_cheque_pag->count() }}</td>
            </tr>
            <tr>
                <td id="titulo">MONTO PAGADO A LA FECHA</td>
                <td id="cont"> $ {{  number_format($resParcelas->PC_valor_cuota*$resParcelas->parcela_cheque_pag->count(),0,",","."); }}</td>
            </tr>
             <tr>
                <td id="titulo">SALDO POR PAGAR</td>
                <td id="cont">$  {{  number_format(($resParcelas->PC_valor_cuota*$resParcelas->PC_cant_cheques)-($resParcelas->PC_valor_cuota*$resParcelas->parcela_cheque_pag->count()),0,",","."); }}</td>
            </tr>

        @elseif($resParcelas->PC_forma_pago == 2)
            <tr>
                <td id="titulo">MONTO</td>
                <td id="cont"> $ {{  number_format($resParcelas->PC_monto,0,",","."); }}</td>
            </tr>
        
       @else

             <tr>
                <td id="titulo">FECHA INICIO TRANSFERENCIAS</td>
                <td id="cont"> {{  \Carbon\Carbon::parse($resParcelas->PC_fecha_inicio_transf)->format('d-m-Y'); }}</td>
            </tr>
            <tr>
                <td  id="titulo">CUPO OTORGADO</td>
                <td id="cont"> $ {{  number_format($resParcelas->PC_cupo_otransf,0,",","."); }}</td>
            </tr>
            <tr>
                <td  id="titulo">TASA ANUAL</td>
                <td id="cont"> {{  number_format($resParcelas->PC_tasa_anual_transf,0,",","."); }} %</td>
            </tr>
            <tr>
                <td  id="titulo">CUOTAS - CREDITO</td>
                <td id="cont"> {{  $resParcelas->PC_cant_transf }}</td>
            </tr>
            <tr>
                <td  id="titulo">VALOR CUOTA</td>
                <td id="cont"> $ {{  number_format($resParcelas->PC_valor_transf,0,",","."); }}</td>
            </tr>
            <tr>
                <td id="titulo">FECHA ULTIMA CUOTA</td>
                <td id="cont"> {{  \Carbon\Carbon::parse($resParcelas->PC_fecha_ultima_transf)->format('d-m-Y'); }}</td>
            </tr>
            
            <tr>
                <td id="titulo">CUOTAS EN MORA</td>
                <td id="cont"> {{  $resParcelas->parcela_transfer_atr->count() }}</td>
            </tr>
            <tr>
                <td id="titulo">MONTO EN MORA</td>
                <td id="cont"> $ {{  number_format($resParcelas->parcela_transfer_atr->sum('TR_monto'),0,",","."); }}</td>
            </tr>
            <tr>
                <td id="titulo">CUOTAS PAGADAS A LA FECHA</td>
                <td id="cont"> {{  $resParcelas->parcela_transfer_pag->count() }}</td>
            </tr>
           <tr>
                <td id="titulo">MONTO PAGADO A LA FECHA</td>
                <td id="cont"> $ {{  number_format($resParcelas->parcela_transfer_pag->sum('TR_monto'),0,",","."); }}</td>
            </tr>
             <tr>
                <td id="titulo">SALDO POR PAGAR</td>
                <td id="cont">$  {{  number_format(($resParcelas->PC_valor_transf*$resParcelas->PC_cant_transf)-($resParcelas->parcela_transfer_pag->sum('TR_monto')),0,",","."); }}</td>
            </tr>
          

        @endif

    </tbody>
</table>