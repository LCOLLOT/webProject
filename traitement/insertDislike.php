<?php
session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

$article_id = htmlspecialchars($_POST['idArticle']);

try{
    $req =$bdd->prepare('UPDATE articles SET jaimepas = jaimepas+1 WHERE id = "'.$_POST['idArticle'].'"');
    $req->execute(array("article_id"=>$article_id));
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}


header("Location: ../acceuil.php");
exit();
?>