<?php
include ('affichage/header.php');

?>
    <h2>Messagerie de  monsieur <strong><?php echo $_SESSION['user']; ?></strong></h2>
    <h2>Envoyer un message</h2>
    <div class="row">
        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-5 col-md-5 col-sm-5">
            <table class="table">
                <form class="well" method="post" action="traitement/insertMessage.php" enctype="multipart/form-data">
                    <tr><td>Destinataire <input type="text" name="destinataire" class="form-control"/></td></tr>
                    <tr><td>Message <input type="text" name="message" class="form-control"/></td></tr>
                    <tr><td><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-send"></span> Envoyer</button></td></tr>
                </form>
            </table>
        </div>
    </div>

<?php
include ('affichage/footer.php');
?>