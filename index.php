<?php
require_once 'header.php';
?>
<link rel="stylesheet" href="assets/css/style.css">
<section class="sport text-center">
    <article class="sport-list container mb-5">
        <h1 class="text-center">Bienvenue sur SportBook!</h1>
        <p>Discutez de votre sport favoris et rencontrez-vous</p>

        <h2>Voici la liste des sports :</h2>
        <div class="row text-center">

            <?php
            $req = queryMySql("SELECT name, image FROM sport");
            while ($sport = $req->fetch()) 
            {?>
                
                    <div class = "col-md-6">
                            <div class = "row">
                                <div class="card">
                                    <img class= "card-img-top" src="assets/images/<?=  $sport['image']?>" alt="<?= $sport['image']?>">
                                    <div class=card-body>
                                        <h4 class="sport-list-title"><?= $sport['name']?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
        <?php } ?>

            
        </div>

        </div>

    </article>

</section>






<?php
require_once 'footer.php';
?>

</body>

</html>