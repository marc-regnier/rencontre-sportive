<?php

require_once '../functions/functions.php';

$username = security($_POST['username']);

if(isset($username)){
    $stmt = $bdd->prepare("SELECT count(*) as cntUser FROM user WHERE username=:username");
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    $response = "<span style='color: green;'>&nbsp;&#x2714;Ce username " . $username . " est disponible.</span>";
    if ($count > 0) {
        $response = "<span style='color: red;'>&nbsp;&#x2718;Ce username " . $username . " n'est pas disponible.</span>";
    }

    echo $response;
    exit;


}