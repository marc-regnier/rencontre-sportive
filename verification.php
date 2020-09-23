<?php
require_once 'functions.php';


$name = htmlentities($_POST['name']);
$firstname = htmlentities($_POST['firstname']);
$department = htmlentities($_POST['department']);
$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);
$gender = $_POST['sexe'];
$sport = $_POST['sport'];
$level = $_POST['level'];
$fileName = basename($_FILES["image"]["name"]);


if(isset($name) && !empty($name) && isset($firstname) && !empty($firstname) && isset($department) && !empty($department) && isset($email) && !empty($email) && isset($password) && !empty($password)
&& isset($gender) && !empty($gender) && isset($fileName) && !empty($fileName)&& isset($sport) && !empty($sport) && isset($level) && !empty($level))
{

$allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($allowTypes))
        {
             
            $password_crypt = password_hash($password, PASSWORD_DEFAULT);

            queryMySql("INSERT INTO user (lastname, firstname, department, mail, password, image_cover, gender, id_niveau, id_sport) 
            VALUES('$name', '$firstname', '$department', '$email', '$password_crypt', '$fileName', '$gender', '$level', '$sport')");
        }
        header("location: login.php");
}
else if($gender == "m" && empty($fileName) && isset($name) && !empty($name) && isset($firstname) && !empty($firstname) && isset($department) && !empty($department) && isset($email) && !empty($email) && isset($password) && !empty($password)
&& isset($sport) && !empty($sport) && isset($level) && !empty($level))
{
    $filename = "masculin_default.jpg";
    
    $password_crypt = password_hash($password, PASSWORD_DEFAULT);
    var_dump($filename);
    
    queryMySql("INSERT INTO user (lastname, firstname, department, mail, password, image_cover, gender, id_niveau, id_sport)
     VALUES('$name', '$firstname', '$department', '$email', '$password_crypt', '$filename', '$gender', '$level', '$sport')");

    header("location: login.php");

}
else if($gender == "f" && empty($fileName) && isset($name) && !empty($name) && isset($firstname) && !empty($firstname) && isset($department) && !empty($department) && isset($email) && !empty($email) && isset($password) && !empty($password)
&& isset($sport) && !empty($sport) && isset($level) && !empty($level))
{
        $fileName = "feminin_default.jpg";
        
        $password_crypt = password_hash($password, PASSWORD_DEFAULT);
    
            queryMySql("INSERT INTO user (lastname, firstname, department, mail, password, image_cover, gender, id_niveau, id_sport)
             VALUES('$name', '$firstname', '$department', '$email', '$password_crypt', '$fileName', '$gender', '$level', '$sport')");

            header("location: login.php");

}
else
{
    header("location: ajout.php");
}