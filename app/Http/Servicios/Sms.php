<?php 
namespace App\Http\Servicios;


class Sms implements NotificacionesInterface
{
    public function mensaje($asunto)
    {
        // TODO: Implementar el método uploadCV()
        return 'Sms '.$asunto;
    }
}