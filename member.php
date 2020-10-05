<?php
$page = "les membres";
require_once('header/header.php');

if (!$loggedin) {
    $session->setFlash('Vous ne pouvez pas accéder à cette page car vous n\'êtes pas connecté. ');
    header("location: login.php");
}

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}

$count = queryMySql("SELECT COUNT(*) AS nb_member FROM user");
$res = $count->fetch();

$nbMembers = (int) $res['nb_member'];



$byPage = 9;

$pages = ceil($nbMembers / $byPage);


$first = ($currentPage * $byPage) - $byPage;

$count = "SELECT * FROM user INNER JOIN sport ON user.id_sport = sport.id INNER JOIN level ON user.id_niveau = level.id ORDER BY 'created_at' DESC LIMIT :first, :bypage;";
$query = $bdd->prepare($count);
$query->bindValue(':first', $first, PDO::PARAM_INT);
$query->bindValue(':bypage', $byPage, PDO::PARAM_INT);
$query->execute();
$members = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<section class="member text-center">

    <article class="member-list container mb-5">
        <div class="row">
            <?php
            foreach ($members as $member) {
            ?>
                <div class="card-member col-md-4 mt-5">
                    <div class="row">
                        <div class="card card-img " style="width : 18rem; ">
                            <img class="card-img-top" style="height : 250px;" src="../assets/images/uploads/<?= $member['image_cover'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $member['lastname'] ?> <?= $member['firstname'] ?></h5>
                                <p class="card-text "><?= $member['name'] ?> - <?= $member['niveau'] ?></p>
                                <a href="pageProfile.php?username=<?= $member['username'] ?>" class="btn btn-primary">Plus d'infos</a>
                                <?php
                                if (isset($_GET['add'])) {
                                    $add = security($_GET['add']);

                                    $result = queryMySql("SELECT * FROM friends WHERE user='$add' AND friend = '$user'");
                                    if (!$result->rowCount())
                                        queryMySql("INSERT INTO friends VALUES('$add', '$user')");
                                } else if (isset($_GET['remove'])) {
                                    $remove = security($_GET['remove']);
                                    queryMySql("DELETE FROM friends WHERE user = '$remove' AND friend = '$user'");
                                }


                                $result1 = queryMySql("SELECT * FROM friends WHERE user='" . $member['username'] . "' AND friend = '$user'");
                                $t1 = $result1->rowCount();
                                $result1 = queryMySql("SELECT * FROM friends WHERE user = '$user' AND friend='" . $member['username'] . "'");
                                $t2 = $result1->rowCount();

                                if ($member['username'] !== $user) {
                                    if (!$t1) { ?>
                                        <a href="member.php?add=<?= $member['username'] ?>" class="btn btn-primary">Suivre</a>
                                    <?php } else {

                                    ?>
                                        <a href="member.php?remove=<?= $member['username'] ?>" class="btn btn-danger">supprimer le lien</a>
                                <?php }

                                    if (($t1 + $t2) > 1)

                                        echo "<p>Vous êtes Amis</p>";

                                    else if ($t1)

                                        echo "<p>Vous suivez cette personne</p>";

                                    else if ($t2)

                                        echo "<p>Cette personne vous suit</p>";
                                    else echo "<p>aucun lien d'amitié</p>";
                                };
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>

    </article>
    <nav class="page container">
        <ul class="pagination text-center mt-4">
            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                <a href="member.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
            </li>
            <?php for ($page = 1; $page <= $pages; $page++) : ?>
                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="member.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
            <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                <a href="member.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
            </li>
        </ul>
        </nav>
    </article>
</section>

<?php
include 'header/footer.php';
?>