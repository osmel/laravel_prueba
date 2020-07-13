<?php 
namespace App\Http\Servicios;


class Correo implements NotificacionesInterface
{
    public function mensaje($asunto)
    {
        // TODO: Implementar el método uploadCV()
        return 'Correo '.$asunto;
    }
}