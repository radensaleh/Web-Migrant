<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'kd_user' => $faker->unique()->randomDigit,
        'nama_lengkap' => $faker->name,
        'jenis_kelamin' => $faker->title,
        'nomer_hp' => $faker->randomDigit,
        'email' => $faker->unique()->safeEmail,
        // 'email_verified_at' => now(),
        'password' => $faker->password, // password
        'provinsi' => $faker->country,
        'daerah' => $faker->city,
        'nama_daerah' =>$faker->streetName,
        'detail_alamat' =>$faker->address,
        'foto_user' => $faker->imageUrl,
        'status' =>$faker->boolean,
        // 'remember_token' => Str::random(10),
    ];
});
