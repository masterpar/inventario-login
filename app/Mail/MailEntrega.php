<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailEntrega extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $usuario,$elemento,$fecha_devolucion,$observacion;
    public function __construct($usuario,$elemento,$fecha_devolucion,$observacion)
    {
        $this->usuario = $usuario;
        $this->elemento= $elemento;
        $this->fecha_devolucion= $fecha_devolucion;
        $this->observacion= $observacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.entrega')
                    ->subject('Entrega de elemento');
    }
}
