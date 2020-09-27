<?php
require_once 'header.php';


if(!$loggedin){
    header("location: login.php");
}
?>

<h3>Mon profil</h3>
<?php
$result = queryMySql("SELECT * FROM user WHERE mail = '$user'");

