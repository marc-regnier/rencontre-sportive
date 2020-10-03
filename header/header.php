<?php

require_once('class/session.class.php');
$session = new Session();
$session->flash();
session_write_close();
session_start();


require_once('functions/functions.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>SportBook! - <?= $page ?></title>
</head>

<body>
  <?php

  if (isset($_SESSION['user']))
  {
    $user = $_SESSION['user'];
    $loggedin = TRUE;
  }
  else 
  {
    $loggedin = FALSE;
  }
  ?>
  <header>
    <?php
    if ($loggedin) { ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">SportBook!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="member.php">Membres</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profil.php">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="friends.php">Amis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="message.php">Message</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Déconnexion</a>
            </li>
          </ul>
        </div>
      </nav>
    <?php } else { ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">SportBook!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Accueil</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="ajout.php">Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Connexion</a>
            </li>
          </ul>
        </div>
      </nav>
    <?php } ?>
  </header>