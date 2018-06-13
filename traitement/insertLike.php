<?php
session_start();
include('../log/pdo.php');


try{
    $req = $bdd->prepare('INSERT INTO likearticle(article_id, auteur_id) VALUES (:article_id,:auteur_id)');
    $req->execute(array('article_id'=>$_POST['idLike'], 'auteur_id'=>$_SESSION['user_id']));

    $req2 = $bdd->prepare('INSERT INTO dislikearticle(article_id, auteur_id) VALUES (:article_id,:auteur_id)');
    $req2->execute(array('article_id'=>$_POST['idDislike'], 'auteur_id'=>$_SESSION['user_id']));

    $req3 = $bdd->prepare('INSERT INTO signalement(article_id, auteur_id) VALUES (:article_id,:auteur_id)');
    $req3->execute(array('article_id'=>$_POST['idSignal'], 'auteur_id'=>$_SESSION['user_id']));
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

header("Location: ../acceuil.php");
exit();
?>