<?php
require_once '../functions/functions.php';



if (isset($_POST['username'])) {
    $username = security($_POST['username']);
    $pass = security($_POST['password']);

    if ($username == "" || $pass == ""){
        require("../class/session.class.php");
        $session = new Session();
        $session->setFlash('ERREUR ! SVP Veuillez remplir tous les champs du formulaire de connexion');
        header("location: ../login.php");
    }
    else {
        $req = $bdd->prepare("SELECT * FROM user WHERE username = :username");
        $req->execute(array('username' => $username));
        $result = $req->fetch();
        $passCorrect = password_verify($pass, $result['password']);

        if ($passCorrect) {
            $_SESSION['user'] = $username;
            $_SESSION['password'] = $pass;
            require("../class/session.class.php");
            $session = new Session();
            $session->setFlash('Vous êtes connecté', 'success');
            header("location: ../profil.php");
        } else {
            require("../class/session.class.php");
            $session = new Session();
            $session->setFlash('ERREUR ! Utilisateur ou mot de passe non valide');
            header("location: ../login.php");
        }
    }
}


?>