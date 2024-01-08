<table>
    <thead>
    <tr>
        <th style="font-weight: bold;  text-align: center;">#</th>
        <th style="font-weight: bold;  text-align: center; width: 230px;">PROYECTO</th>
        <th style="font-weight: bold;  text-align: center; width: 80px;">N° PARCELA</th>
        <th style="font-weight: bold;  text-align: center; width: 150px;">NOMBRE PARCELA</th>
        <th style="font-weight: bold;  text-align: center; width: 230px;">CLIENTE</th>
        <th style="font-weight: bold;  text-align: center; width: 80px;">MONEDA</th>
        <th style="font-weight: bold;  text-align: center; width: 150px;">VALOR PARCELA UF</th>
        <th style="font-weight: bold;  text-align: center; width: 150px;">VALOR PARCELA</th>
        <th style="font-weight: bold;  text-align: center; width: 200px;">FORMA PAGO</th>
        <th style="font-weight: bold;  text-align: center; width: 100px;">RESERVA</th>
        <th style="font-weight: bold;  text-align: center; width: 100px;">PIE</th>
        <th style="font-weight: bold;  text-align: center; width: 150px;">MONTO CONTADO</th>
        <th style="font-weight: bold;  text-align: center; width: 150px;">INICIO CREDITO</th>
        <th style="font-weight: bold;  text-align: center; width: 100px;">CUOTAS</th>
        <th style="font-weight: bold;  text-align: center; width: 150px;">CUPO OTORGADO</th>
        <th style="font-weight: bold;  text-align: center; width: 150px;">VALOR CUOTA</th>
        <th style="font-weight: bold;  text-align: center; width: 200px;">CUPO TRANSFERENCIA</th>
        <th style="font-weight: bold;  text-align: center; width: 200px;">CANTIDAD TRANSFERENCIA</th>
        <th style="font-weight: bold;  text-align: center; width: 200px;">INICIO TRANSFERENCIA</th>
        <th style="font-weight: bold;  text-align: center; width: 200px;">VALOR TRANSFERENCIA</th>
        <th style="font-weight: bold;  text-align: center; width: 200px;">CUOTAS PAGADAS A LA FECHA</th>
        <th style="font-weight: bold;  text-align: center; width: 200px;">MONTO PAGADO A LA FECHA</th>
        <th style="font-weight: bold;  text-align: center; width: 200px;">SALDO POR PAGAR</th>
        <th style="font-weight: bold;  text-align: center; width: 200px;">COMPORTAMIENTO PAGO</th>  
        <th style="font-weight: bold;  text-align: center; width: 150px;">ESTADO PARCELA</th>  
        <th style="font-weight: bold;  text-align: center; width: 300px;">DOC FACTURA</th>  
        <th style="font-weight: bold;  text-align: center; width: 300px;">DOC ALZAMIENTO</th>  
    </tr>
    </thead>
    <tbody>
    @foreach($parcelas as $parce)
        <tr>
            <td style="text-align: center;" valign="center">{{ $parce->ID_parcela }} </td>           
            <td style="text-align: center;" valign="center">{{ $parce->pc_proyecto->PR_nombre }} </td>           
            <td style="text-align: center;" valign="center">{{ $parce->PC_num_parcela}} </td>           
            <td style="text-align: center; word-wrap: break-word;"valign="center">{{ $parce->PC_nombre }}</td>
            <td style="text-align: center;" valign="center">{{ $parce->cliente->CL_nombre}} </td> 
            @if($parce->PC_tipo_cambio == 1)
                <td style="text-align: center;" valign="center">PESOS</td>    
            @else       
                <td style="text-align: center;" valign="center">UF</td>           
            @endif

            <td style="text-align: center;" valign="center">{{ $parce->PC_valor_parcela_uf}} </td>           
            <td style="text-align: center;" valign="center">{{ $parce->PC_valor_parcela}} </td>

            @if($parce->PC_forma_pago == 1)
                <td style="text-align: center;" valign="center">CREDITO DIRECTO</td>  
            @elseif($parce->PC_forma_pago == 2)
                <td style="text-align: center;" valign="center">CONTADO</td>  
            @else
                <td style="text-align: center;" valign="center">TRANSFERENCIA MENSUAL</td>  
            @endif

            <td style="text-align: center;" valign="center">{{ $parce->PC_reserva}} </td>
            <td style="text-align: center;" valign="center">{{ $parce->PC_pie}} </td>
            <td style="text-align: center;" valign="center">{{ $parce->PC_monto}} </td>
            @if($parce->PC_inicio_credito == NULL)
            <td style="text-align: center;" valign="center"> - </td>
             @else       
                <td style="text-align: center;" valign="center">{{ \Carbon\Carbon::parse($parce->PC_inicio_credito)->format('d-m-Y');}} </td>          
            @endif

            <td style="text-align: center;" valign="center">{{ $parce->PC_cant_cheques}} </td>
            <td style="text-align: center;" valign="center">{{ $parce->PC_cupo_otorgado}} </td>
            <td style="text-align: center;" valign="center">{{ $parce->PC_valor_cuota}} </td>
            <td style="text-align: center;" valign="center">{{ $parce->PC_cupo_otransf}} </td>
            <td style="text-align: center;" valign="center">{{ $parce->PC_cant_transf}} </td>
            @if($parce->PC_fecha_inicio_transf == NULL)
                <td style="text-align: center;" valign="center"> - </td>
            @else   
                <td style="text-align: center;" valign="center">{{ \Carbon\Carbon::parse($parce->PC_fecha_inicio_transf)->format('d-m-Y');}} </td>
            @endif
            <td style="text-align: center;" valign="center">{{ $parce->PC_valor_transf}} </td>
            
            @if($parce->PC_forma_pago == 1)
                <td style="text-align: center;" valign="center"> {{  $parce->parcela_cheque_pag->count() }}</td>  
            @elseif($parce->PC_forma_pago == 2)
                <td style="text-align: center;" valign="center">-</td>  
            @else
                <td style="text-align: center;" valign="center">{{ $parce->parcela_transfer_pag->count() }}</td>  
            @endif

            @if($parce->PC_forma_pago == 1)
                <td style="text-align: center;" valign="center"> {{  $parce->PC_valor_cuota*$parce->parcela_cheque_pag->count() }}</td>  
            @elseif($parce->PC_forma_pago == 2)
                <td style="text-align: center;" valign="center">-</td>  
            @else
                <td style="text-align: center;" valign="center">{{ $parce->parcela_transfer_pag->sum('TR_monto') }}</td>  
            @endif


             @if($parce->PC_forma_pago == 1)
                <td style="text-align: center;" valign="center"> {{  ($parce->PC_valor_cuota*$parce->PC_cant_cheques)-($parce->PC_valor_cuota*$parce->parcela_cheque_pag->count()) }}</td>  
            @elseif($parce->PC_forma_pago == 2)
                <td style="text-align: center;" valign="center">-</td>  
            @else
                <td style="text-align: center;" valign="center">{{ ($parce->PC_valor_transf*$parce->PC_cant_transf)-($parce->parcela_transfer_pag->sum('TR_monto'))}}</td>  
            @endif

            <td style="text-align: center;" valign="center">{{ $parce->com_pago->CP_nombre}} </td>
            <td style="text-align: center;" valign="center">{{ $parce->estado->E_nombre}} </td>
            
            @if($parce->PC_factura == NULL)
                <td style="text-align: center;" valign="center"> - </td>
             @else
                <td style="text-align: center;" valign="center"><a href="{{asset('storage/parcelas_adj/'. $parce->PC_factura) }}"></a>{{ $parce->PC_factura }}</td>
             @endif

             @if($parce->PC_alzamiento == NULL)
                <td style="text-align: center;" valign="center"> - </td>
             @else
                <td style="text-align: center;" valign="center"><a href="{{asset('storage/parcelas_adj/'. $parce->PC_alzamiento) }}"></a>{{ $parce->PC_alzamiento }}</td>
             @endif

        </tr>
    @endforeach
    </tbody>
</table>