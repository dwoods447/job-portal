<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Company;
use App\Job;
use App\Category;
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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'user_type'=>$faker->randomElement($array = array('seeker', 'employer')),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});



$factory->define(Company::class, function (Faker $faker) {

    $user_id = User::select('id')->inRandomOrder()->where('user_type', 'employer')->first();

    return [
        'user_id' => $user_id->id,
        'company_name' => $name=$faker->company,
        'slug' => str_slug($name),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'website' => $faker->domainName,
        'logo' => 'http://placehold.it/80x80',
        'cover_photo' => 'http://placehold.it/200x200',
        'slogan' => $faker->randomElement($array = array('Learning and Growing', 'I\'m Hating It', 'Finger Lickin’ Bad', 'Beanz Meanz Things', 'Taste the Rainbow Swish!', 'They’re NOT That GR-R-R-reat')),
        'description' => $faker->paragraph(rand(2,10)),
    ];
});




$factory->define(Job::class, function (Faker $faker) {
    $user_id = User::select('id')->inRandomOrder()->where('user_type', 'employer')->first();
    $userID = $user_id->id;
    $companies = Company::inRandomOrder()->where('user_id', $userID)->get();
        return [
            'user_id' => $userID,
            'company_id' => $companies[0]->id,
            'title' =>$title=$faker->jobTitle,
            'slug' =>str_slug($title),
            'description' => $faker->paragraph(rand(2,10)),
            'roles' => $faker->text,
            'category_id' => rand(1,5),
            'position' => $title,
            'address' => $faker->address,
            'job_type' => $faker->randomElement($array = array('full-time', 'part-time', 'contract', 'internship', 'temporary', 'commision')),
            'status' => rand(0,1),
            'last_date' => $faker->DateTime,
        ];



});


