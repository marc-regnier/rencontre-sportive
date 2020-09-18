<?php
require_once 'functions.php';


$name = $_POST['name'];
$firstname = $_POST['firstname'];
$department = $_POST['department'];
$email = $_POST['email'];
$password = $_POST['password'];
$sport = $_POST['sport'];
$level = $_POST['level'];


if(isset($name) && !empty($name) && isset($firstname) && !empty($firstname) && isset($department) && !empty($department) && isset($email) && !empty($email) && isset($password) && !empty($password)
&& isset($sport) && !empty($sport) && isset($level) && !empty($level))
{
    queryMySql("SELECT * FROM practice
    INNER JOIN user ON practice.id_user = user.id
    INNER JOIN sport ON sport.id = practice.id_sport 
    ");
   
   queryMySql("INSERT INTO user (lastname, firstname, department, mail, password, id_niveau)
    VALUES('$name', '$firstname', '$department', '$email', '$password', $level)");

    queryMySql("INSERT INTO practice (id_user, id_sport)
    VALUES($id , $sport)");
      

}else{
    echo 'erreur';
}