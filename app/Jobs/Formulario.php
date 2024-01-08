<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormContacto;
use Carbon\Carbon;
use App\form_contactos;

class Formulario implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $form;
    

    public function __construct($form)
    {
        $this->form = $form;
        
        
    }

    public function handle()
    {
        $form = $this->form;

        
                    $title = 'UN CLIENTE SE HA CONTACTADO';

                    $mensaje = '<table style= "width:100%;
                                                border-collapse: collapse;">';
                        
                            $mensaje .= '<tr style="text-align: left;">';

                                $mensaje .= '<td style="
                                                    padding: 15px;
                                                    font-family: Verdana;
                                                    color: black;
                                                    font-size: initial;
                                                    font-weight: bold;
                                                    width: 150px;">
                                                        NOMBRE: </td>';

                                $mensaje .= '<td style="
                                                    padding: 15px;
                                                    font-family: Verdana;
                                                    color: black;
                                                    font-size: initial;
                                                    ">'.$form->FC_nombre.'</td>';
                                
                            $mensaje .= '</tr>';

                            $mensaje .= '<tr style="text-align: left;">';

                                $mensaje .= '<td style="
                                                        padding: 15px;
                                                        font-family: Verdana;
                                                        color: black;
                                                        font-weight: bold;
                                                        font-size: initial;">EMAIL: </td>';

                                $mensaje .= '<td style="
                                                        padding: 15px;
                                                        font-family: Verdana;
                                                        color: black;
                                                        font-size: initial;">'.$form->FC_correo.'</td>';    
                            $mensaje .= '</tr>';

                            $mensaje .= '<tr style="text-align: left;">';

                                $mensaje .= '<td style="
                                                        padding: 15px;
                                                        font-family: Verdana;
                                                        color: black;
                                                        font-weight: bold;
                                                        font-size: initial;">TELEFONO: </td>';

                                $mensaje .= '<td style="
                                                        padding: 15px;
                                                        font-family: Verdana;
                                                        color: black;
                                                        font-size: initial;">'.$form->FC_telefono.'</td>';    
                            $mensaje .= '</tr>';

                            $mensaje .= '<tr style="text-align: left;">';

                                $mensaje .= '<td style="
                                                        padding: 15px;
                                                        font-family: Verdana;
                                                        color: black;
                                                        font-weight: bold;
                                                        font-size: initial;">MENSAJE: </td>';

                                $mensaje .= '<td style="
                                                        padding: 15px;
                                                        font-family: Verdana;
                                                        color: black;
                                                        font-size: initial;">'.$form->FC_consulta.'</td>';    
                            $mensaje .= '</tr>';

                    $mensaje .= '</table>';

                Mail::to(['informatica@aglospinos.cl'])->cc(['rain.maribel@gmail.com'])
                   ->send(new FormContacto([], $title, $mensaje));



                   // Mail::to(['gerencia@aglospinos.cl'])->cc(['rojeda@aglospinos.cl'])
              //      ->send(new FormContacto([], $title, $mensaje)); 
        

                    
                

   }             
                
}
