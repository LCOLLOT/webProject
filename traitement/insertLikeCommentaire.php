<?php
session_start();
include('../log/pdo.php');

$id_commentaire = htmlspecialchars($_GET['idCom']);
$auteur_id = htmlspecialchars($_SESSION['user_id']);

try{
    $req =$bdd->prepare('INSERT INTO likecom(commentaire_id,auteur_id) VALUES (:commentaire_id,:auteur_id)');
    $req->execute(array("commentaire_id"=>$id_commentaire,"auteur_id"=>$auteur_id));
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}


header("Location: ../acceuil.php");
exit();
?>