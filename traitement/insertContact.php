<?php
session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
}
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$mail = htmlspecialchars($_POST['mail']);
$sujet = htmlspecialchars($_POST['sujet']);
$message = htmlspecialchars($_POST['message']);
$nb = rand(100,100000);

try {
    $req = $bdd->prepare('INSERT INTO reclamations(nom,prenom,mail,sujet,message) VALUES (:nom,:prenom,:mail,:sujet,:message)');
    $req->execute(array("nom" => $nom, "prenom" => $prenom, "mail" => $mail, "sujet" => $sujet,"message" => $message));

}catch(Exception $e){
    die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
}
?>