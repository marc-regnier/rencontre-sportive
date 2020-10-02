<?php
$page = "votre profil";
require_once 'header/header.php';



if(!$loggedin){
    header("location: login.php");
}



$req = queryMySql("SELECT * FROM user WHERE username = '$user'");
$member = $req->fetch();
$title = ($member['gender'] == 'm') ? 'M.' : 'Mme';



?>


<div class="container card mt-4">
<h3 class="text-center">Bonjour <?= $title ?> <?= $member['firstname'] ?> !</h3>
<div class="profile">
    <img src="assets/images/uploads/<?= $member['image_cover'] ?>" height="250px" width="250px">
    <div class="text">
    <?= $member['description'] ?>
    </div>
   
</div>
<form action="check/checkProfil.php" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="exampleInputPassword1">Photo ou Image :</label>
    <input type="file" name="image" id="image"  class="form-control" />
</div>
<div class="form-group">
    <label for="exampleInputPassword1">Décrivez-vous :</label>
    <textarea id="editor" name="editor" rows="5" cols="33">
    <?= $member['description']?>
    </textarea>
</div>
<div class="text-center">
<input type="submit" class="btn btn-primary">
<input type="reset" class="btn btn-danger">
</div>
</form>
</div>

<script src="ckeditor_4.15.0_standard/ckeditor/ckeditor.js"></script>
<script>
    // Turn off automatic editor creation first.
    CKEDITOR.disableAutoInline = true;
    var editor =  CKEDITOR.replace( 'editor' );
</script>
<?php 
include 'header/footer.php';

?>

