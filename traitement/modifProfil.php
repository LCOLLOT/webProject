<?php
    session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

    $nom = htmlspecialchars($_POST['nom']);
    $dateN = htmlspecialchars($_POST['dateNaissance']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);

    $req = $bdd->prepare('UPDATE users SET `name`= :nom, mail = :mail, pseudo = :pseudo, `date`=:dateN WHERE id = :id');
    $req->execute(array('nom'=>$nom , 'mail'=> $mail, 'pseudo'=>$pseudo, 'dateN' => $dateN, 'id'=>$_SESSION['user_id']));

header("Location: ../acceuil.php");
exit();