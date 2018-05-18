<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class CorreoRecuperacion extends Mailable
{
    use Queueable, SerializesModels;

    public $recuperar;

    public function __construct(Request $recuperar)
    {
        $this->recuperar = $recuperar;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Correos.recuperar');
    }
}
