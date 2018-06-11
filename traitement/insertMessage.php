<?php
    include ('../log/pdo.php');
?>

<?php

    $destinataire = $_POST['destinataire'];
    $message = $_POST['message'];
        $req = $bdd->prepare('INSERT INTO messages VALUES(NULL, :message,"'.$_SESSION['user_id'].'" ,(SELECT id from users WHERE mail = "'.$destinataire.'"), "aujourdhui")');
        $req->execute(array('message'=> $message));
?>
<div>
    <p>Message Envoyé !</p>
    <a class="btn btn-default" href="../messagerie.php" role="button"><span class="glyphicon glyphicon-pencil"></span> Retour</a>
</div>


<?php

?>