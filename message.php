<?php
require_once 'header.php';

if(!$loggedin){
    header("location: login.php");
}

if(isset($_GET['view'])) $view = security($_GET['view']);
else $view = $user;

if(isset($_POST['text'])){
    $text = security($_POST['text']);

    if($text != ""){
        $pm = substr(security($_POST['pm']),0,1);
        $time = time();
        queryMysql("INSERT INTO messages VALUES(NULL, '$user', '$view', '$pm', $time, '$text')");
    }

}

if($view != "")
{
    if($view == $user){
        $name1 = $name2 = "Vos";
        echo "<div class='container list-friend mt-5'><h3>$name1 messages</h3>";
    }else{
        $name1 = "<a href='members.php?view=$view'>$view</a>";
        $name2 = "$view -";
        echo "<div class='container list-friend mt-5'><h3>Messages de $name1</h3>";
    }

    


?>

<form action="message.php?view=<?=$view?>" method="post" >
    <fieldset>
        <legend>Ecrivez votre message&nbsp;:</legend>
        <input type="radio" name="pm" id="public" value="0" checked>
        <label for="public">Public</label>
        <input type="radio" name="pm" id="private" value="1" checked>
        <label for="private">Privé</label>
    </fieldset>
    <textarea name="text"></textarea>
    <input type="submit" value="Publier le message">
</form>

<br>

<?php

date_default_timezone_set('UTC');

if(isset($_GET['erase'])){
    $erase = security($_GET['erase']);
    queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
}

if($view == $user){
    $query = "SELECT * FROM messages ORDER BY time DESC";
}
else{
    $query = "SELECT * FROM messages WHERE auth='$view' ORDER BY time DESC";
}

$result = queryMySql($query);
$num = $result->rowCount();

for($j = 0; $j < $num; ++$j)
{
    $row = $result->fetch(PDO::FETCH_ASSOC);

    if($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user)
    {
        echo date('d/m \à H \h i', $row['time']);
        echo "<a href='message.php?view=". $row['auth'] . "'>" . $row['auth'] . "</a>";

    if($row['pm'] == 0)
        echo "a écrit&nbsp;: <span class='whisper'>&laquo;&nbsp" .  $row['message'] . "&nbsp;&raquo;";
    else
        echo "a chuchoté&nbsp;: <span class='whisper'>&laquo;&nbsp;" . $row['message'] . "&nbsp;&raquo;</span>";
    if($row['recip'] == $user)
        echo "[<a href='message.php?view=$view" . "&erase=" .  $row['id'] . "'>suppr.</a>]";

    echo '</br>';
    }
}
}

if(!$num)
    echo "<br><span class='info'>Aucun message</span><br><br>";
    echo "<br><a class='btn btn-success' href='message.php?view=$view'>Actualiser</a>";
    echo "</div>";
?>

<?php

require_once 'footer.php';