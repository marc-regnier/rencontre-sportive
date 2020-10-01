<?php
require_once 'header/header.php';


?>

<section class="container mt-5 mb-5 form-subscription">
<h1 class="text-center color">Inscription à Sportbook</h1>

<form class="mb-5"  action="check/verification.php" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="exampleInputPassword1">Photo ou Image :</label>
    <input type="file" name="image" id="image"  class="form-control" />
</div>
<img id="previewHolder" width="250px" height="250px" />

<div class="form-group">
    <label for="exampleInputEmail1">Nom :</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nom">
</div>

<div class="form-group">
    <label for="exampleInputPassword1">Prénom :</label>
    <input type="text" name="firstname" class="form-control" id="exampleInputPassword1" placeholder="prenom">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Département :</label>
    <input type="text" class="form-control" name="department" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="departement">    
</div>

<div class="form-group">
    <label for="exampleInputPassword1">Username :</label>
    <input type="text" name="username" class="form-control" id="exampleInputPassword1" placeholder="email">
</div>

<div class="form-group">
    <label for="exampleInputPassword1">Mot de Passe :</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="mot de passe">
</div>

<div class="form-group">
    <label for="exampleFormControlSelect1">Sexe :</label>
    <select class="form-control" name="sexe" id="exampleFormControlSelect1">
    <option>Choisir un sexe</option>
      <option value="m">Masculin</option>
      <option value="f">Féminin</option>
    </select>
  </div>

<div class="form-group">
    <label for="exampleSelect1">Sport pratiqué :</label>
      <select class="form-control" name="sport" id="exampleSelect1">
      <option>Choisissez votre sport!</option>
      <?php 
      $req = queryMySql("SELECT * FROM sport");
      while ($sport = $req->fetch()){?>
          <option value="<?=$sport['id']?>"><?=$sport['name']?></option>;
      <?php
      }
    ?>
    </select>
</div>

<div class="form-group">
    <label for="exampleSelect1">Niveau :</label>
      <select class="form-control" name="level" id="exampleSelect1">
      <?php 
      $req = queryMySql("SELECT * FROM level");
      while ($niveau = $req->fetch()){?>
          <option value="<?=$niveau['id']?>"><?=$niveau['niveau']?></option>;
      <?php
      }
    ?>
    </select>
</div>

<div class="text-center">
    <input class="btn btn-primary" type="submit" value="Envoyer">
    <input class="btn btn-danger" type="reset" value="Annuler">
</div>
</form>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets/js/app.js"></script>
<?php
require_once 'header/footer.php';
?>