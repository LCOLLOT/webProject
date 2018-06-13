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
<!-- Ceci est mon corps -->
<div class="container">
    <!-- Ceci est mon sang -->
    <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
            <li><a href="acceuil.php"><img src="images/logo.png" alt="web-trotter" class="logo"></a></li>
            <li> <a href="acceuil.php">Accueil</a></li>
            <li> <a href="newArticle.php">Ajouter un article</a> </li>
            <li> <a href="messagerie.php">Messagerie</a> </li>
            <li> <a href="admin.php">Pannel administrateur</a> </li>
        </ul>
        <div class="pull-right">
            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Compte <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span>Mon profil</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-picture"></span> Mes Contributions</a></li>
                <li> <a href="messagerie.php"<span class="glyphicon glyphicon-comment"></span>>Messagerie</a> </li>
                <li class="divider"></li>
                <li><a href="index.php?disconnect=true"><span class="glyphicon glyphicon-list-alt"></span>Se Déconnecter</a></li> </ul>
        </div>
    </nav>
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>