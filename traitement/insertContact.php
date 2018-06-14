<?php
session_start();
include('../log/pdo.php');

$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$mail = htmlspecialchars($_POST['email']);
$sujet = htmlspecialchars($_POST['sujet']);
$message = htmlspecialchars($_POST['message']);

try {
    $req = $bdd->prepare('INSERT INTO reclamations(nom,prenom,mail,sujet,message) VALUES (:nom,:prenom,:mail,:sujet,:message)');
    $req->execute(array("nom" => $nom, "prenom" => $prenom, "mail" => $mail, "sujet" => $sujet,"message" => $message));

}catch(Exception $e){
    die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreurs
}


header("Location: ../acceuil.php");
exit();
?>