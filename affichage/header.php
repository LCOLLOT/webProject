<?php
    //session_start();
session_cache_limiter('private_no_expire, must-revalidate');
    require 'object/article.php';
    require 'object/Profil.php';
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
<!-- COMMENTAIRE : ici, je place le corps de mon site -->
<div class="container">
        <nav class="navbar navbar-default">
            <ul class="nav navbar-nav">
                <li><a href="acceuil.php"><img src="images/logo.png" alt="web-trotter" class="logo"></a></li>
                    <li> <a href="acceuil.php">Accueil</a></li>
                    <li> <a href="newArticle.php">Ajouter un article</a> </li>
                    <li> <a href="messagerie.php">Messagerie</a> </li>
                    <li> <a href="contact.php">Nous contacter</a> </li>
            </ul>
            <div class="pull-right" id="buttonH">
                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Compte <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span>Mon profil</a></li>
                    <li><a href="contributions.php"><span class="glyphicon glyphicon-picture"></span> Mes Contributions</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?disconnect=true"><span class="glyphicon glyphicon-list-alt"></span>Se Déconnecter</a></li>
                </ul>
            </div>
        </nav>
<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>