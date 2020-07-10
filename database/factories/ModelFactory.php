<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Student;
use App\Teacher;
use App\User;
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

$factory->define(Teacher::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'profession' => $faker->randomElement($array = array('Database','AI','Algorithme')),
    ];
});

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'career' => $faker->randomElement($array = array('Database','AI','Algorithme')),
    ];
});
$factory->define(Course::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'description' => $faker->paragraph(4),
        'value' => $faker->numberBetween(1,4),
        'teacher_id' => mt_rand(1,50),
    ];
});
