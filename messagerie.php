<?php
include ('affichage/header.php');
include('log/pdo.php');
$reponse = $bdd->prepare('SELECT users.name, messages.contenu, messages.date FROM users, messages WHERE messages.auteur_id = users.id AND destinataire_id = :idUser ORDER BY messages.id DESC');
$reponse->execute( array("idUser"=>$_SESSION['user_id']));
?>

    <h2>Messagerie de  monsieur <strong><?php echo $_SESSION['user']; ?></strong></h2>
    <a class="btn btn-default" href="newMessage.php" role="button"><span class="glyphicon glyphicon-pencil"></span> Nouveau Message</a>
    <!--$insertion = $bdd->prepare('INSERT INTO messages VALUES(NULL,"'.$contenu.'""'.$_SESSION['user_id'].'",);
    $insertion->execute(); -->
<?php
    echo '<h3>Vos Messages :</h3>';
    while($donnees = $reponse->fetch()){
        echo '<h4>'.'De : '.$donnees['name'].', '.$donnees['date'].' :'.'</h4>';
        echo '<h4>'.$donnees['contenu'].'</h4>';
    }
?>
<?php
include ('affichage/footer.php');
?>