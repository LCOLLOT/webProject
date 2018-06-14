<?php
include ('affichage/header.php');
include('log/pdo.php');
$reponse = $bdd->prepare('SELECT users.name, messages.contenu, messages.date, messages.id, messages.auteur_id, users.mail FROM users, messages WHERE messages.auteur_id = users.id AND destinataire_id = :idUser ORDER BY messages.id DESC');
$reponse->execute( array("idUser"=>$_SESSION['user_id']));
$reponse2 = $bdd->prepare('SELECT users.name, messages.contenu, messages.date, messages.id, messages.destinataire_id FROM users, messages WHERE messages.destinataire_id = users.id AND auteur_id = :idUser ORDER BY messages.id DESC');
$reponse2->execute( array("idUser"=>$_SESSION['user_id']));

?>

    <h2>Messagerie de <strong><?php echo $_SESSION['user']; ?></strong></h2>
    <a class="btn btn-default" href="newMessage.php" role="button"><span class="glyphicon glyphicon-pencil"></span> Nouveau Message</a>

<?php
    echo '<h3>Messages Reçus :</h3>';
    while($donnees = $reponse->fetch()){
        ?>
        <div class="well well-sm">
            <table>
                <span class="glyphicon glyphicon-comment"></span><?php echo ' De : '.$donnees['name'].', '.$donnees['date'].' :';?>
                <?php echo '<h4>'.$donnees['contenu'].'</h4>'; ?>
                <td>
                    <form method="post" action="traitement/insertMessage.php" enctype="multipart/form-data">
                        <input type="text" name="msgsuppr" value="<?php echo $donnees['id'] ?>"hidden/>
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </td>
                <td>
                    <button class="btn btn-default"><a href="newMessage.php?dest=<?php echo $donnees['mail'];?>"><span class="glyphicon glyphicon-arrow-left"></a></span></button>
                </td>
            </table>
        </div>
        <?php
    }
?>

<?php
echo '<h3>Messages Envoyés :</h3>';
while($donnees = $reponse2->fetch()){
    ?>
    <div class="well well-sm">
        <span class="glyphicon glyphicon-comment"></span><?php echo ' A : '.$donnees['name'].', '.$donnees['date'].' :';?>
        <?php echo '<h4>'.$donnees['contenu'].'</h4>'; ?>
    </div>
    <?php
}
?>

<?php
include ('affichage/footer.php');
?>