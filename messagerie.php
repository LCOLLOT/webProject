<?php
include ('affichage/header.php');
include('log/pdo.php');
$reponse = $bdd->prepare('SELECT users.name, messages.contenu, messages.date, messages.id FROM users, messages WHERE messages.auteur_id = users.id AND destinataire_id = :idUser ORDER BY messages.id DESC');
$reponse->execute( array("idUser"=>$_SESSION['user_id']));
?>

    <h2>Messagerie de <strong><?php echo $_SESSION['user']; ?></strong></h2>
    <a class="btn btn-default" href="newMessage.php" role="button"><span class="glyphicon glyphicon-pencil"></span> Nouveau Message</a>

<?php
    echo '<h3>Vos Messages :</h3>';
    while($donnees = $reponse->fetch()){
        ?>
        <div class="well well-sm">
            <span class="glyphicon glyphicon-comment"></span><?php echo ' De : '.$donnees['name'].', '.$donnees['date'].' :';?>
            <?php echo '<h4>'.$donnees['contenu'].'</h4>'; ?>
            <form method="post" action="traitement/insertMessage.php" enctype="multipart/form-data">
                <input type="text" name="msgsuppr" value="<?php echo $donnees['id'] ?>"hidden/>
                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
            </form>
        </div>
        <?php
    }
?>
<?php
include ('affichage/footer.php');
?>