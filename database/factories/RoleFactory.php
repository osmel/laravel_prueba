<?php

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
    	'nombre_rol' => $faker->name,     //sentence = oracion aleatoria  ->son 245 caracteres
    								 //safeEmail = correo aleatorio
    								//name = nombre aleatorio


        //
    ];
});
