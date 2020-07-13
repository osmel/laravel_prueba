<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Servicios\NotificacionesInterface as NotificacionesInterface;
use App\Http\Servicios\Correo as Correo;
use App\Http\Servicios\Push as Push;
use App\Http\Servicios\Sms as Sms;

class NotificacionesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        /*En el metodo register... Le permite a nuestro ServiceProvider registrar bindings en el contenedor de Laravel. Estamos definiendo un biding, y estamos registrando la clase en el services container. 


        services container: Imaginarlo como una caja, que se registran todas nuestros enlances y esos enlaces nos dan accesos a nuestras clases */


    //Para registrar un enlace, debemos haber definido "la clase" que queremos instanciar (una clase que represente a nuestro servicio).


        //ejemplo 1: No necesita crear un binding pues MiClase no tiene dependencia
    /*
    $this->app->bind(MiClase::class, function ($app) {
             return new MiClase();
    });
    */


    //ejemplo 2: Este es el caso en que MiClase tiene dependencias q es claseA
    // la propiedad "$app" : proporciona acceso al service container:
    /*$this->app->singleton(MiClase::class, function ($app) {
        return new MiClase( new ClaseA() );
    });
    */

    //Ejemplo 3: Asociando una interfaz a nuestra clase
         //Correo, SMS, PUSH 
        //$this->app->bind(NotificacionesInterface::class, Correo::class);
        //$this->app->bind(NotificacionesInterface::class, Push::class);
        //$this->app->bind(NotificacionesInterface::class, Sms::class);

            $this->app->bind(NotificacionesInterface::class, function ($app) {
                //var_dump($this->app);
                 return new Push();
            });

          

            /*
            nota: Un service provider ha registrado nuestro servicio en el service container, y podemos usar nuestro servicio desde donde nos plazca (gracias a la inyección de dependencias).
            */


        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
