<?php
    session_start();
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
                    <li><img src="images/web-trotter.png" alt="web-trotter" class="logo"></li>
                    <li> <a href="#">Accueil</a></li>
                    <li> <a href="#">Patrimoine</a> </li>
                    <li> <a href="#">Messagerie</a> </li>
            </ul>
            <div class="pull-right">
                <button class="btn btn-info">Compte</button>
                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Mon Profil</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-picture"></span> Mes Contributions</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Se Déconnecter</a></li> </ul>
            </div>
        </nav>
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>