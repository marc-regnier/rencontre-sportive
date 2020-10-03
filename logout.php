<?php
require_once 'header/header.php';

require_once 'functions/functions.php';

if(isset($_SESSION['user'])){
    destroySession();
    $session->setFlash('Vous êtes déconnecté', 'success');
    header('location: login.php');
}else{
    
    $session->setFlash('Vous ne pouvez pas vous déconnecter car vous n\'êtes pas connecté. ');
    header('location: login.php');
}