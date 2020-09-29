<?php
require_once 'header.php';

require_once 'functions.php';

if(isset($_SESSION['user'])){
    destroySession();
    $session = new Session();
    $session->setFlash('Vous êtes déconnecté', 'success');
    header('location: index.php');
}else{
    $session = new Session();
    $session->setFlash('Vous ne pouvez pas vous déconnecter car vous n\'êtes pas connecté. ');
    header('location: login.php');
}