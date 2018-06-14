<?php
session_cache_limiter('private_no_expire, must-revalidate');
include ('log/pdo.php');
include ('object/Profil.php');

if (!isset($_SESSION) || !isset($_SESSION["user_id"]))
{
    header("Location: index.php");
    exit();
}
$userId = $_SESSION["user_id"];
$profil = new Profil($userId);

if ($profil->getGroupe() != "admin")
{
    http_response_code(403);
    echo "Page interdite w4nn4-83-h4x0r";
    exit();
}

require 'object/article.php';
require 'object/distCalculator.php';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Web-Trotter</title>
    <link rel="stylesheet" href="add.css" />
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
</head>

<body>
<div class="row">
    <div id="titreHead">
        <h1>Web-Trotter</h1>
    </div>
</div>
<!-- Ceci est mon corps -->
<img src="images/back.jpg" alt="informatique" class="img-responsive">
<nav class="navbar navbar-inverse" id="barreNav">
    <div class="pull-left">
        <a href="acceuil.php"><img src="images/logo.png" alt="web-trotter" class="logo"></a>
    </div>
    <ul class="nav navbar-nav">
            <!--<li> </li>-->
            <li> <a href="acceuil.php">Accueil</a> </li>
            <li> <a href="newArticle.php">Ajouter un lieu</a> </li>
            <li> <a href="contact.php">Contact</a> </li>


        </ul>
        <div class="pull-right" id="buttonH">
            <?php if (isset($_SESSION['user'])) { ?>
                <div class="btn btn-default disabled" style="cursor:default;"><span class="glyphicon glyphicon-check"></span> <?php echo $_SESSION['user']; ?>, <?php echo $profil->getGroupe(); ?> </div>
            <?php } ?>

            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Compte <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span> Mon profil</a></li>
                <li><a href="contributions.php"><span class="glyphicon glyphicon-picture"></span> Mes Contributions</a></li>
                <li><a href="messagerie.php"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
                <?php
                if ($profil->getGroupe() == "moderateur" || $profil->getGroupe() == "admin" )
                {
                    echo "<li class=\"divider\"></li>";
                    echo "<li> <a href=\"editarticle.php\"><span class=\"glyphicon glyphicon-wrench\"></span> Modération</a> </li>";
                } ?>
                <?php
                if ($profil->getGroupe() == "admin")
                {
                    echo "<li> <a href=\"admin.php\"><span class=\"glyphicon glyphicon-console\"></span> Panel Admin</a> </li>";
                } ?>
                <li class="divider"></li>
                <li><a href="index.php?disconnect=true"><span class="glyphicon glyphicon-log-in"></span> Se Déconnecter</a></li>
            </ul>
        </div>
    </nav>
<div class="container">
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>