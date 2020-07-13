<?php 
namespace App\Http\Servicios;


class Push implements NotificacionesInterface
{
    public function mensaje($asunto)
    {
        // TODO: Implementar el método uploadCV()
        return 'Notificaciones Push '.$asunto;
    }
}