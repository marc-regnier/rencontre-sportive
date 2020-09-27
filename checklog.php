<?php


require_once 'header.php';
require_once 'functions.php';



if (isset($_POST['email'])) {
    $mail = security($_POST['email']);
    $pass = security($_POST['password']);




    if ($mail == "" || $pass == ""){
        $session = new Session();
        $session->setFlash('ERREUR ! SVP Veuillez remplir tous les champs du formulaire de connexion');
        header("location: login.php");
    }
    else {
        $req = $bdd->prepare("SELECT * FROM user WHERE mail = :mail");
        $req->execute(array('mail' => $mail));
        $result = $req->fetch();
        $passCorrect = password_verify($pass, $result['password']);

        if ($passCorrect) {
            $_SESSION['email'] = $mail;
            $_SESSION['password'] = $pass;
            $session = new Session();
            $session->setFlash('Vous êtes connecté', 'success');
            header("location: login.php");
        } else {
            
            $session = new Session();
            $session->setFlash('ERREUR ! Utilisateur ou mot de passe non valide');
            header("location: login.php");
        }
    }
}


?>