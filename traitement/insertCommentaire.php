<?php
    session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', 'root');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

    $article_id = htmlspecialchars($_POST['article_id']);
    $auteur_id = htmlspecialchars($_POST['auteur_id']);
    $date = htmlspecialchars($_POST['date']);
    $id = htmlspecialchars($_POST['id']);
    $texte = htmlspecialchars($_POST['texte']);

    try{
        $req =$bdd->prepare('INSERT INTO commentaires(article_id,auteur_id,date,id,texte) VALUES (:article_id,:auteur_id,:date,:id,:texte)');
        $req->execute(array("article_id"=>$article_id,"auteur_id"=>$auteur_id,"date"=>$date,"id"=>$id,"texte"=>$texte));
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }


header("Location: ../acceuil.php");
exit();