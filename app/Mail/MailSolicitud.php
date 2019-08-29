<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class MailSolicitud extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $usuario,$email,$elementos,$nom_peticion,$f_solicitud,$f_devolucion,$justificacion;

    public function __construct($usuario,$email,$elementos,$nom_peticion,$f_solicitud,$f_devolucion,$justificacion)
    {
        $this->usuario = $usuario;
        $this->email= $email;
        $this->elementos = $elementos;
        $this->f_solicitud = $f_solicitud;
        $this->f_devolucion = $f_devolucion;
        $this->justificacion = $justificacion;
        $this->nom_peticion = $nom_peticion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.nueva_solicitud')
                    ->subject('Nueva solicitud de elemento');
    }
}
