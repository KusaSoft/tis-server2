<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emitido,$nombre,$motivo,$materia,$estudiantes,$fechaReserva,$hora_ini,$hora_fin,$estado,$aulas,$motivoRechazo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emitido,$nombre,$motivo,$materia,$estudiantes,$fechaReserva,$hora_ini,$hora_fin,$estado,$aulas){
        $this->emitido = $emitido;
        $this->nombre = $nombre;
        $this->motivo = $motivo;
        $this->materia = $materia;
        $this->estudiantes = $estudiantes;
        $this->fechaReserva = $fechaReserva;
        $this->hora_ini = $hora_ini;
        $this->hora_fin = $hora_fin;
        $this->estado = $estado;
        $this->aulas = $aulas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservationConfirmation');
    }
}
