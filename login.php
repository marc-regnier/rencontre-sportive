<?php
$page = "connexion";
require_once ('header/header.php');


?>
<div class="container card mt-4">

    <form action="check/checklog.php" method="POST">
        <fieldset>
            <legend class="text-center card-title">Connectez-vous</legend>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Username </label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Entrez votre username">

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mot de passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Saisir votre mot de passe">
            </div>
            <input class="btn btn-primary" type="submit"  value="Je me connecte">

        </fieldset>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets/js/app.js"></script>
<?php
require_once ('header/footer.php');
?>



