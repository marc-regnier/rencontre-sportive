<?php
require_once 'vendor/autoload.php';
require 'functions/functions.php';


$faker = Faker\Factory::create("fr_FR");

$gender = ['m', 'f'];
$genre = $faker->randomElement($gender);
$password = $faker->password;
$level = $faker->numberBetween(1, 4);
$sport = $faker->numberBetween(1, 8);
$date = $faker->dateTimeBetween('-6months');
$createDate = $date->format('d/m/y');


$picture = ($genre == 'm' ? 'masculin_default.jpg' : 'feminin_default.jpg');

$password_crypt = password_hash($password, PASSWORD_DEFAULT);


for($i = 0; $i <= 20; $i++){
    queryMySql("INSERT INTO user SET lastname ='{$faker->lastname}', firstname = '{$faker->firstname}', department = '{$faker->departmentNumber}', username = '{$faker->username}', 
    password = '$password_crypt', image_cover = '$picture', gender = '$genre', id_niveau = '$level', id_sport =  '$sport', description = '{$faker->sentence()}', created_at = '$createDate'");
}

