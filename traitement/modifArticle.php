<?php
session_start();
include('../log/pdo.php');


    $titre = htmlspecialchars($_POST['titre']);
    $lattitude = htmlspecialchars($_POST['lattitude']);
    $longitude = htmlspecialchars($_POST['longitude']);
    $description = htmlspecialchars($_POST['description']);
    $id_article = $_POST['id_article'];

    $req = $bdd->prepare('UPDATE articles SET titre = :titre, lattitude = :lattitude, longitude = :longitude, description = :description WHERE id = :id_article');
    $req->execute(array('titre'=>$titre, 'lattitude'=>$lattitude, 'longitude' => $longitude, 'description'=>$description, 'id_article'=>$id_article));

header("Location: ../acceuil.php");
exit();