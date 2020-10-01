<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=reseau_sport;charset=utf8;port=3308', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

function queryMySql($query)
{
    global $bdd;
    $result = $bdd->query($query);
    if (!$result) die("Erreur fatale");
    return $result;
}


function security($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }



function destroySession()
{
    $_SESSION =[];

    if (session_id() != "" || isset($_COOKIE[session_name()]))
    setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}
