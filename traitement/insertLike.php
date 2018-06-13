<?php
session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', 'root');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}



try{
    $req =$bdd->prepare('UPDATE articles SET jaime = jaime+1 WHERE id = "'.$_POST['idLike'].'"');
    $req->execute();
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}
try{
    $req2 =$bdd->prepare('UPDATE articles SET articles = signalement=signalement+1 WHERE id = "'.$_POST['idSignal'].'"');
    $req2->execute();
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

try{
    $req3 =$bdd->prepare('UPDATE articles SET jaimepas = jaimepas+1 WHERE id = "'.$_POST['idDislike'].'"');
    $req3->execute();
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}


header("Location: ../acceuil.php");
exit();
?>