<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormContacto extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $form;
    protected $title;
    protected $mensaje;
    
    
    public function __construct($form, $title, $mensaje)
    {
        $this->title = $title;
        $this->mensaje = $mensaje;
        $this->form = $form;
       
    }

    public function build()
    {
        $email = $this->view('emails.email_recibido')
        ->with([
            'title' => $this->title,
            'mensaje' => $this->mensaje,
            'form' => $this->form,
            
        ])
        ->subject($this->title);

        return $email;
    }
}
