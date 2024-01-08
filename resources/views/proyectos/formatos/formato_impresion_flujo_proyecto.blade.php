<style type="text/css">
    td {
        padding: 5px 5px 5px 5px;
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

    td#titulo_p {
        color: black;
        width: 400px;

    }

    td#cont_p {
        font-weight: bold;
        font-size: 18px;
        text-align: center;
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
                <h1 style="width:100% ; font-family: Arial, Helvetica, sans-serif;">FLUJO DE PROYECTO</h1>
                <h2 style="color: black; font-family: Arial, Helvetica, sans-serif;">PROYECTO: {{ $proyf->PR_nombre }}</h2>
            </th>
        </tr>
    </thead>
</table>
<br>
<table border="1px" width="100%">
    <tbody>
    	<tr>
            <td id="titulo_p">FECHA INICIO DE VENTAS</td>
            <td id="cont_p">{{  \Carbon\Carbon::parse($proyf->PR_fecha_inicio_ventas)->format('d-m-Y'); }}</td>
        </tr>

        <tr>
            <td id="titulo_p">TOTAL UNIDADES PROYECTO</td>
            <td id="cont_p">{{ $proyf->PR_total_unidades }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">UNIDADES VENDIDAS AL CONTADO</td>
            <td id="cont_p">{{ $proyf->proy_parcela_cont->count() }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">PORCENTAJE DE VENTAS AL CONTADO</td>
            <td id="cont_p">{{ (($proyf->proy_parcela_cont->count()*100)/100) }} %</td>                    
        </tr>

        <tr>
            <td id="titulo_p">UNIDADES VENDIDAS CON CRÉDITO DIRECTO</td>
            <td id="cont_p">{{ $proyf->proy_parcela_cd->count() }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">PORCENTAJE DE VENTAS CON CRÉDITO DIRECTO</td>
            <td id="cont_p">{{ (($proyf->proy_parcela_cd->count()*100)/100) }} %</td>                    
        </tr>

        <tr>
            <td id="titulo_p">MONTO TOTAL RECAUDADO DE UNIDADES VENDIDAS A LA FECHA</td>
            <td id="cont_p">$ {{ number_format(($proyf->proy_parcela->sum('PC_reserva'))+($proyf->proy_parcela->sum('PC_pie'))+($proyf->proy_parcela->sum('PC_monto'))+($proyf->proy_cheque_cd->sum('CHQ_monto')),0,",",".") }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">MONTO TOTAL RECAUDADO DE UNIDADES VENDIDAS A LA FECHA CON C.D</td>
            <td id="cont_p">$ {{ number_format(($proyf->proy_parcela_cd->sum('PC_reserva'))+($proyf->proy_parcela_cd->sum('PC_pie'))+($proyf->proy_cheque_cd->sum('CHQ_monto')),0,",",".") }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">CANTIDAD DE CHEQUES RECEPCIONADOS A LA FECHA</td>
            <td id="cont_p">{{ $proyf->proy_cheques->count() }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">N° DE CHEQUES A DEPOSITAR MENSUAL</td>
            <td id="cont_p">{{ $proyf->proy_parcela_cd->count() }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">FLUJO $ MENSUAL POR CHEQUES A DEPOSITAR</td>
            <td id="cont_p">$ {{ number_format($proyf->proy_parcela->sum('PC_valor_cuota'),0,",",".") }}</td>                    
        </tr>

         <tr>
            <td id="titulo_p">CHEQUES PROTESTADOS NO PAGADOS HISTÓRICO</td>
            <td id="cont_p">{{ $proyf->proy_cheque_reb->count() }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">MONTO TOTAL DE CHEQUES PROTESTADOS NO PAGADOS HISTÓRICO</td>
            <td id="cont_p">$ {{ number_format($proyf->proy_cheque_reb->sum('CR_monto_cheque'),0,",",".") }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">CHEQUES PROTESTADOS NO PAGADOS ACTUALES</td>
            <td id="cont_p">{{ $proyf->proy_cheque_reb_real->count() }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">MONTO TOTAL CHEQUES PROTESTADOS NO PAGADOS ACTUALES</td>
            <td id="cont_p">$ {{ number_format($proyf->proy_cheque_reb_real->sum('CHQ_monto'),0,",",".") }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">FECHA FINAL DE VENTAS DEL PROYECTO</td>
            <td id="cont_p">{{ (($proyf->PR_fecha_fin_ventas == null) ? '-' : \Carbon\Carbon::parse($proyf->PR_fecha_fin_ventas)->format('d-m-Y')) }}</td>                    
        </tr>

        <tr>
            <td id="titulo_p">FECHA DEL ÚLTIMO CHEQUE A COBRAR</td>
            <td id="cont_p">{{  \Carbon\Carbon::parse($proyf->proy_parcela->max('PC_fecha_ultima_cuota'))->format('d-m-Y') }}</td>                    
        </tr>
        
    </tbody>
</table>