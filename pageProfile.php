<?php
require_once 'header.php';

$view = security($_GET['mail']);

$req = queryMySql("SELECT * FROM user WHERE mail = '$view'");
$member = $req->fetch();



?>

<div class="container card mt-4">
<h3 class="text-center">Bienvenu sur le profil de <?= $member['lastname'] ?> <?= $member['firstname'] ?> !</h3>
    <div class="profile">
        <img src="assets/images/uploads/<?= $member['image_cover'] ?>" height="250px" width="250px">
        <div class="text">
        <?= $member['description'] ?>
    </div>
</div>
    <button class="btn btn-primary mt-4"><a href="">Laisser un message</a></button>

