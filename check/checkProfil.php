<?php
require_once('../class/session.class.php');
$session = new Session();
$session->flash();
session_write_close();
session_start();

require_once('../functions/functions.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $loggedin = TRUE;
} else {
    $loggedin = FALSE;
}

$req = queryMySql("SELECT * FROM user WHERE username = '$user'");
$member = $req->fetch();

if (isset($_POST['editor'])) {
    $text = $_POST['editor'];

    if ($req->rowCount())
        queryMysql("UPDATE user SET description = '$text' WHERE username = '$user'");
    else queryMySql("INSERT INTO user VALUES ('$user', '$text')");
    header("location: ../profil.php");
} else {
    header("location: ../profil.php");
}


if (isset($_FILES["image"]["name"])) {
    $fileName = basename($_FILES["image"]["name"]);
    $targetDir = "../assets/images/uploads/";
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {

            queryMysql("UPDATE user SET image_cover = '$fileName' WHERE username = '$user'");
        }
        header("location: ../profil.php");
    }
} else {
    header("location: ../profil.php");
}
