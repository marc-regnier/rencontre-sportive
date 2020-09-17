<?php
require_once 'header.php';
?>
<h1 class="text-center">Inscription à Sportbook</h1>
<form class="container" action="verification.php" method="post">

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
    <label for="exampleInputPassword1">Email :</label>
    <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="email">
</div>
<div class="form-group">
    <label for="exampleInputPassword1">Mot de Passe :</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="email">
</div>

<div class="form-group">
    <label for="exampleSelect1">Sport pratiqué :</label>
      <select class="form-control" name="sport" id="exampleSelect1">
      <option>Choisissez!</option>
      <?php 
      $req = queryMySql("SELECT name FROM sport");
      $sport = $req->fetchAll(PDO::FETCH_COLUMN);
      foreach ($sport as $name => $value){
          echo "<option>$value</option>";
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
<?php 
    
?>
<div class="text-center">
    <input class="btn btn-primary" type="submit" value="Envoyer">
    <input class="btn btn-danger" type="reset" value="Annuler">
</div>
</form>