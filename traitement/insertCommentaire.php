<?php
    session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

    $article_id = htmlspecialchars($_POST['idArticle']);
    $auteur_id = htmlspecialchars($_SESSION['user_id']);
    $texte = htmlspecialchars($_POST['texte']);

    try{
        $req =$bdd->prepare('INSERT INTO commentaires(article_id,auteur_id,`date`,texte) VALUES (:article_id,:auteur_id,date("F j, Y, g:i a"),:texte)');
        $req->execute(array("article_id"=>$article_id,"auteur_id"=>$auteur_id,"texte"=>$texte));
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }


header("Location: ../acceuil.php");
exit();