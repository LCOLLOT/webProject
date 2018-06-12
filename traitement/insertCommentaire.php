<?php
    session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', 'root');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}
$article_id = htmlspecialchars($_POST['idArticle']);
$auteur_id = htmlspecialchars($_SESSION['user_id']);
$texte = htmlspecialchars($_POST['text']);
try {
    $req2 = $bdd->prepare('SELECT pseudo FROM users WHERE id = :auteur_id');
    $req2->execute(array("auteur_id"=>$auteur_id));
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}
$texte = $req2->fetch()['pseudo']." : ".$texte;
try{
    $req =$bdd->prepare('INSERT INTO commentaires(article_id,auteur_id,`date`,texte) VALUES (:article_id,:auteur_id, NOW(),:texte)');
    $req->execute(array("article_id"=>$article_id,"auteur_id"=>$auteur_id,"texte"=>$texte));
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}


header("Location: ../acceuil.php");
exit();
?>