<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailElementoDev extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $usuario,$elemento,$petition_nom,$cantidad_dev;
    public function __construct($usuario,$elemento,$petition_nom,$cantidad_dev)
    {
        $this->usuario = $usuario;
        $this->elemento= $elemento;
        $this->petition_nom= $petition_nom;
        $this->cantidad_dev= $cantidad_dev;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.elementodev')
                    ->subject('Entrega de elemento');
    }
}
