<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
}
$pseudo = htmlspecialchars($_POST['pseudo']);
$name = htmlspecialchars($_POST['name']);
$mail = htmlspecialchars($_POST['mail']);
$password = htmlspecialchars($_POST['password']);
$photo = $pseudo;

echo $pseudo;

try {
    $req = $bdd->prepare('INSERT INTO users(name, mail, password, pseudo, date, photo) VALUES (:name, :mail, :password, :pseudo, NOW(), :photo)');
    $req->execute(array("name" => $name, "mail" => $mail, "password" =>  $password, "pseudo" => $pseudo, "photo" =>$photo));

}catch(Exception $e){
    die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
}

header("Location: ../index.php");