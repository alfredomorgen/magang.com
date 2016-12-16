<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'jobseeker', function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('qwerty'),
        'role' => \App\Constant::user_jobseeker,
        'phone' => $faker->phoneNumber,
        'location' => $faker->address,
        'photo' => 'j'.$faker->biasedNumberBetween(1, 10).'.jpg',
        'description' => $faker->catchPhrase,
        'status' => \App\Constant::status_active,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Jobseeker::class, function(Faker\Generator $faker) use ($factory){
    return [
        'gender' => $faker->biasedNumberBetween(0, 1),
        'dob' => $faker->date('Y-m-d', 'now'),
        'gpa' => $faker->randomFloat(2, 1, 4),
        'major' => $faker->jobTitle,
        'university' => $faker->company,
    ];
});

$factory->defineAs(App\User::class, 'company', function (Faker\Generator $faker) use ($factory) {
    static $password;

    return [
        'name' => $faker->company,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('qwerty'),
        'role' => \App\Constant::user_company,
        'phone' => $faker->phoneNumber,
        'location' => $faker->address,
        'photo' => 'c'.$faker->biasedNumberBetween(1, 10).'.png',
        'description' => $faker->catchPhrase,
        'status' => \App\Constant::status_active,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Company::class, function(Faker\Generator $faker) use ($factory){
    return [
        'website' => $faker->domainName,
        'industry' => $faker->jobTitle,
        'size' => $faker->biasedNumberBetween(0, 1000),
    ];
});

$factory->define(App\Job::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'name' => $faker->jobTitle,
        'deadline' => $faker->dateTimeBetween('now', '+ 30 days'),
        'location' => $faker->address,
        'type' => $faker->biasedNumberBetween(0, 1),
        'salary' => $faker->biasedNumberBetween(0, 1),
        'period' => $faker->biasedNumberBetween(1, 24),
        'benefit' => $faker->sentence,
        'requirement' => $faker->bs,
        'description' => $faker->catchPhrase,
        'status' => \App\Constant::status_active,
    ];
});

$factory->define(App\Job_Interest::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'jobseeker_id' => $faker->biasedNumberBetween(1, 20),
        'job_category_id' => $faker->biasedNumberBetween(1, 14),
        'name' => $faker->jobTitle,
        'status' => \App\Constant::status_active,
    ];
});