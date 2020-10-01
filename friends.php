<?php
require_once 'header/header.php';

if(!$loggedin){
    header("location: login.php");
}


if(isset($_GET['view'])) $view = security($_GET['view']);
else $view = $user;


if ($view == $user){
    $name1 = $name2 = "Vos";
    $name3 =          "Vous";

}else{
    $name1 = "<a href='members.php?view=$view'>$view</a>'s";
    $name2 = "$view :";
    $name3 = "$view";
}

$followers = array();
$following = array();

$result = queryMySql("SELECT * FROM friends WHERE user = '$view'");
$num = $result->rowCount();

for($j = 0; $j < $num; ++$j){
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $followers[$j] = $row['friend'];
}

$result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
$num = $result->rowCount();

for($j = 0; $j < $num; ++$j){
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $following[$j] = $row['user'];
}

$mutual = array_intersect($followers, $following);
$followers = array_diff($followers, $mutual);
$following = array_diff($following, $mutual);
$friends = FALSE;

echo "<br><div class = 'container list-friend'>";

if(sizeof($mutual)){
    echo "<span class='subhead'>$name2 amis réciproques :</span><ul>";
    foreach ($mutual as $friend)
        echo "<li><a href='member.php?view=$friend'>$friend</a>";
        echo "</ul>";
        $friends = TRUE;
}

else if(sizeof($followers)){
    echo "<span class='subhead'>$name2 suiveurs :</span><ul>";
    foreach ($followers as $friend)
        echo "<li><a href='member.php?view=$friend'>$friend</a>";
        echo "</ul>";
        $friends = TRUE;
}

else if(sizeof($following)){
    echo "<span class='subhead'>$name3 suivez :</span><ul>";
    foreach ($following as $friend)
        echo "<li><a href='member.php?view=$friend'>$friend</a>";
        echo "</ul>";
        $friends = TRUE;
}

if(!$friends) echo "<br>Vous n'avez pas encore d'ami.";
    echo "</div>"


?>
<?php
require_once 'header/footer.php';
?>