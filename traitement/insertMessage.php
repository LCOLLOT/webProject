<?php
    include ('../log/pdo.php');
    session_start();
?>

<?php
    date_default_timezone_set('Europe/Paris');
    $destinataire = $_POST['destinataire'];
    $message = $_POST['message'];
        $req = $bdd->prepare('INSERT INTO messages VALUES(NULL, :message,:iduser ,(SELECT id from users WHERE mail = "'.$destinataire.'"), "'.date("F j, Y, g:i a").'")');
        $req->execute(array('message'=> $message, 'iduser' => $_SESSION['user_id']));

   header("Location: ../messagerie.php");
   exit();

?>