<?php
require_once 'functions.php';

$image = $_POST['image'];
$name = htmlentities($_POST['name']);
$firstname = htmlentities($_POST['firstname']);
$department = htmlentities($_POST['department']);
$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);
$gender = $_POST['sexe'];
$sport = $_POST['sport'];
$level = $_POST['level'];

if(isset($gender) == "m" && empty($image)){
    $image = "masculin_default.jpg";
}else{
    $image = "feminin_default.jpg";
}

if(isset($name) && !empty($name) && isset($firstname) && !empty($firstname) && isset($department) && !empty($department) && isset($email) && !empty($email) && isset($password) && !empty($password)
&& isset($sport) && !empty($sport) && isset($level) && !empty($level) && isset($gender) && !empty($gender) && isset($image) && !empty($image))
{

    $password_crypt = password_hash($password, PASSWORD_DEFAULT);
    
   queryMySql("INSERT INTO user (lastname, firstname, department, mail, password, image_cover, sexe, id_niveau, id_sport)
    VALUES($name, $firstname, $department, $email, $password_crypt, $image, $gender, $level, $sport)");

}else{
    echo 'erreur';
}

