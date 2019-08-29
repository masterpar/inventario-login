<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailRespuesta extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nom_peticion,$respuesta;
    public function __construct($nom_peticion,$respuesta)
    {
        $this->nom_peticion = $nom_peticion;
        $this->respuesta= $respuesta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.solicitud_respuesta')
                    ->subject('Respuesta solicitud de elementos');
    }
}
