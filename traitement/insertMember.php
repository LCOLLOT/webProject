<?php

include('../log/pdo.php');

$pseudo = htmlspecialchars($_POST['pseudo']);
$name = htmlspecialchars($_POST['name']);
$mail = htmlspecialchars($_POST['mail']);
$password = htmlspecialchars($_POST['password']);
$photo = $pseudo;
$groupe = 'membre';

try {
    $req = $bdd->prepare('INSERT INTO users(name, mail, password, pseudo, date, photo, groupe) VALUES (:name, :mail, :password, :pseudo, NOW(), :photo, :groupe)');
    $req->execute(array("name" => $name, "mail" => $mail, "password" =>  hash('sha256', $password), "pseudo" => $pseudo, "photo" =>$photo, "groupe" => $groupe));

}catch(Exception $e){
    die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
}
if (isset($_FILES['photo']) and $_FILES['photo']['error'] == 0)
{
    $infos_fichier = pathinfo($_FILES['photo']['name']);
    $extension_upload = $infos_fichier['extension'];
    $extensions_autorisees= array('jpg','jpeg','png');

    if (in_array($extension_upload, $extensions_autorisees))
    {
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/users/' .$pseudo.$nb);
    }
}

header("Location: ../index.php");
exit();