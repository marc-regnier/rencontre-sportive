<?php
require_once 'header.php';

$error = $mail = $pass = "";

if (isset($_POST['email'])) {
    $mail = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['password']);




    if ($user == "" || $pass == "")
        $error = "Tous les champs ne sont pas remplis<br><br>";
    else {
        $req = $bdd->prepare("SELECT * FROM user WHERE mail = :mail");
        $req->execute(array('mail' => $mail));
        $result = $req->fetch();

        $passCorrect = password_verify($pass, $result['password']);

        if ($passCorrect) {
            $_SESSION['email'] = $mail;
            $_SESSION['password'] = $pass;
            die("<div class='center'>Vous êtes connecté. Cliquez<a href='members.php?view=$mail'> ici</a> pour continuer.</div></div></body></html>");
        } else {
            $error = "Utilisateur ou mot de passe non valide";
        }
    }
}
?>

<div class="container card mt-4">

    <form action="index.php" method="POST">
        <fieldset>
            <legend class="text-center card-title">Connectez-vous</legend>
            <span class="error"><?= $error ?></span>
            <div class="form-group">
                <label for="exampleInputEmail1">Email </label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Entez votre email" value="<?= $mail ?>">

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mot de passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Saisir votre mot de passe" value="<?= $pass ?>">
            </div>
            <a class="btn btn-primary" type="submit">Valider</a>
        </fieldset>
    </form>
    </body>
</html>

</div>