<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Registro;
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

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'CPF' => $faker->shuffleString('01234567898'),
        'nome' => $faker->firstName,
        'sobrenome' => $faker->lastName,
        'email' => $faker->email
    ];
});

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'cod' => $faker->shuffleString('01231567893'),
        'nome' => $faker->domainName,
        'categoria' => $faker->domainWord(),
        'preco' => $faker->randomFloat(null, 1, 500)
    ];
});

$factory->define(Registro::class, function (Faker $faker) {
    return [
        'cod_venda' => $faker->year,
        'id_func' => $faker->shuffleString('01231567893'),
        'id_clien' => $faker->shuffleString('01231567893'),
        'id_prod' => $faker->shuffleString('01231567893')
    ];
});
