<?php
session_start();
include('../log/pdo.php');


try{
    if(isset($_POST['idLike'])){
        $req = $bdd->prepare('INSERT INTO likearticle(article_id, auteur_id) VALUES (:article_id,:auteur_id)');
        $req->execute(array('article_id'=>$_POST['idLike'], 'auteur_id'=>$_SESSION['user_id']));
    }
    if(isset($_POST['idDislike'])) {
        $req2 = $bdd->prepare('INSERT INTO dislikearticle(article_id, auteur_id) VALUES (:article_id,:auteur_id)');
        $req2->execute(array('article_id' => $_POST['idDislike'], 'auteur_id' => $_SESSION['user_id']));
    }
    if(isset($_POST['idSignal'])) {
        $req3 = $bdd->prepare('INSERT INTO signalement(article_id, auteur_id) VALUES (:article_id,:auteur_id)');
        $req3->execute(array('article_id' => $_POST['idSignal'], 'auteur_id' => $_SESSION['user_id']));
    }
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

if(isset($_POST['idLike'])){
    $article_id = $_POST['idLike'];
}
else if(isset($_POST['idDislike'])) {
    $article_id = $_POST['idDislike'];
}
else {
    $article_id = $_POST['idSignal'];
}

header("Location: ../acceuil.php?article=".$article_id);
exit();
?>