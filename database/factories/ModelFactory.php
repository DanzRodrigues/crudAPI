<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Funcionario;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Funcionario::class, function (Faker $faker) {
    return [
        'CPF' => $faker->shuffleString('01234567898'),
        'nome' => $faker->name,
        'email' => $faker->email,
        'senha' => $faker->password,
        'salario' => $faker->randomFloat(null, 900, 10000)
    ];
});
