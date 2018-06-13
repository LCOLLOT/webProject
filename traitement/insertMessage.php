<?php
session_start();
include('../log/pdo.php');


    date_default_timezone_set('Europe/Paris');
    $destinataire = $_POST['destinataire'];
    $idmsg = $_POST['msgsuppr'];
    $message = $_POST['message'];
    $req = $bdd->prepare('INSERT INTO messages VALUES(NULL, :message,:iduser ,(SELECT id from users WHERE mail = "'.$destinataire.'"), "'.date("F j, Y, g:i a").'")');
    $req->execute(array('message'=> $message, 'iduser' => $_SESSION['user_id']));

    $req2 = $bdd->prepare('DELETE FROM messages WHERE id = :id');
    $req2->execute(array('id' => $idmsg));
   header("Location: ../messagerie.php");
   exit();

?>