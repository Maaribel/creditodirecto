<?php

namespace App\Exports;

use App\parcelas;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ParcelasExcel implements FromView
{
    public function view(): View
    {
        return view('proyectos.formatos.formato_excel_parcelas', [
            'parcelas' => parcelas::whereIn('ID_estado', [1,3,4])->where('ID_proyecto_macro' ,1)->get()
        ]);
    }
}