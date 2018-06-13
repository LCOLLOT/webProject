<?php
session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}
$id_commentaire = htmlspecialchars($_POST['idCommentaire']);
$auteur_id = htmlspecialchars($_SESSION['user_id']);

try{
    $req =$bdd->prepare('INSERT INTO likeCom(commentaire_id,auteur_id) VALUES (:commentaire_id,:auteur_id)');
    $req->execute(array("commentaire_id"=>$id_commentaire,"auteur_id"=>$auteur_id));
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}


header("Location: ../acceuil.php");
exit();
?>