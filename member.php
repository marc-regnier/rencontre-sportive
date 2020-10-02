<?php 
$page = "les membres";
include ('header/header.php');

if(!$loggedin){
    header("location: login.php");
}

?>

<section class="member text-center">

    <article class="member-list container mb-5">
    <div class="row">
<?php
            

            

            $req = queryMySql("SELECT * FROM user INNER JOIN sport ON user.id_sport = sport.id INNER JOIN level ON user.id_niveau = level.id");
            while ($member = $req->fetch()) 
            { 
                if ($member['username'] == $user) continue; ?>
 <div class = "col-md-4 mt-5">
     <div class = "row">
        <div class="card card-img" style="width : 18rem; ">
            <img class="card-img-top" style="height : 250px;" src="../assets/images/uploads/<?= $member['image_cover']?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $member['lastname']?> <?=$member['firstname']?></h5>
                <p class="card-text "><?= $member['name'] ?> - <?= $member['niveau'] ?></p>
                <a href="pageProfile.php?username=<?= $member['username'] ?>" class="btn btn-primary">Plus d'infos</a>
                <?php 
                    if(isset($_GET['add']))
                    {
                        $add = security($_GET['add']);
        
                        $result = queryMySql("SELECT * FROM friends WHERE user='$add' AND friend = '$user'");
                        if(!$result->rowCount())
                            queryMySql("INSERT INTO friends VALUES('$add', '$user')");
                        
                    }
                    else if(isset($_GET['remove']))
                    {
                        $remove = security($_GET['remove']);
                        queryMySql("DELETE FROM friends WHERE user = '$remove' AND friend = '$user'");
                    }
                    

                    $result1 = queryMySql("SELECT * FROM friends WHERE user='" .$member['username'] ."' AND friend = '$user'");
                    $t1 = $result1->rowCount();
                    $result1 = queryMySql("SELECT * FROM friends WHERE user = '$user' AND friend='" . $member['username'] . "'");
                    $t2 = $result1->rowCount();

                    if (!$t1)
                    {?>
                        <a href="member.php?add=<?= $member['username'] ?>" class="btn btn-primary">Suivre</a>
                   <?php } 
                   else 
                   { ?>
                        <a href="member.php?remove=<?= $member['username'] ?>" class="btn btn-danger">supprimer le lien</a>
                   <?php }

                   if(($t1 + $t2) > 1)
                   
                        echo "<p>Vous êtes Amis</p>";
                   
                    else if($t1)
                   
                        echo "<p>Vous suivez cette personne</p>";
                
                    else if ($t2)
                
                        echo "<p>Cette personne vous suit</p>";
                    else echo "<p>aucun lien d'amitié</p>";
                    ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>
</div>
    </article>

</section>

<?php
include 'header/footer.php';
?>