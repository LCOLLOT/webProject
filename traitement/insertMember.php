<?php

include('../log/pdo.php');

$pseudo = htmlspecialchars($_POST['pseudo']);
$name = htmlspecialchars($_POST['name']);
$mail = htmlspecialchars($_POST['mail']);
$password = htmlspecialchars($_POST['password']);
$photo = $pseudo;
$groupe = 'membre';

try {
    $req = $bdd->prepare('INSERT INTO users(name, mail, password, pseudo, date, photo, groupe) VALUES (:name, :mail, :password, :pseudo, NOW(), :photo, :groupe)');
    $req->execute(array("name" => $name, "mail" => $mail, "password" =>  $password, "pseudo" => $pseudo, "photo" =>$photo, "groupe" => $groupe));

}catch(Exception $e){
    die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
}

//header("Location: ../index.php");