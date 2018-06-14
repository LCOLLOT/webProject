<?php
session_start();
include('../log/pdo.php');


try{
    if(isset($_GET['idLike'])){
        $req = $bdd->prepare('INSERT INTO likearticle(article_id, auteur_id) VALUES (:article_id,:auteur_id)');
        $req->execute(array('article_id'=>$_GET['idLike'], 'auteur_id'=>$_SESSION['user_id']));
    }
    if(isset($_GET['idDislike'])) {
        $req2 = $bdd->prepare('INSERT INTO dislikearticle(article_id, auteur_id) VALUES (:article_id,:auteur_id)');
        $req2->execute(array('article_id' => $_GET['idDislike'], 'auteur_id' => $_SESSION['user_id']));
    }
    if(isset($_GET['idSignal'])) {
        $req3 = $bdd->prepare('INSERT INTO signalement(article_id, auteur_id) VALUES (:article_id,:auteur_id)');
        $req3->execute(array('article_id' => $_GET['idSignal'], 'auteur_id' => $_SESSION['user_id']));
    }
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

?>