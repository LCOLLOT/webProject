<?php
session_start();
    include ('../log/pdo.php');
?>

<?php
    var_dump($_SESSION['user_id']);

    $destinataire = $_POST['destinataire'];
    $message = $_POST['message'];
        $req = $bdd->prepare('INSERT INTO messages VALUES(NULL, :message,:idUser ,(SELECT id from users WHERE mail = "'.$destinataire.'"), "aujourdhui")');
        $req->execute(array('message'=> $message,'idUser'=> $_SESSION['user_id']));

header("Location: ../messagerie.php");
exit();
?>
