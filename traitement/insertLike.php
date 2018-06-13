<?php
session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', 'root');
}
catch(Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

try{
    $req =$bdd->prepare('UPDATE articles SET jaime = jaime+1 WHERE id = :likes');
    $req->execute(array( 'likes' => $_POST['idLike']));

    $req2 =$bdd->prepare('UPDATE articles SET signalement = signalement+1 WHERE id = :signal');
    $req2->execute(array( 'signal' => $_POST['idSignal']));

    $req3 =$bdd->prepare('UPDATE articles SET jaimepas = jaimepas+1 WHERE id = :dislike');
    $req3->execute(array( 'dislike' => $_POST['idDislike']));
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

header("Location: ../acceuil.php");
exit();
?>