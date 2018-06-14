<?php
session_start();
include ('affichage/header.php');
?>
    <h2>Poster un commentaire</h2>
        <div class="row">
            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-5 col-md-5 col-sm-5">

                    <form class="com" method="post" action="traitement/insertCommentaire.php" enctype="multipart/form-data">
                        <table class="table">
                        <tr><td>Article concerné<input type="text" name="article" class="form-control"/></td></tr>
                        <tr><td>Commentaire<textarea name="commentaire" rows="10" cols="50" class="form-control"></textarea></td></tr>
                        <tr><td><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-send"></span> Envoyer</button></td></tr>
                        </table>
                    </form>

             </div>
        </div>


<?php
include ('affichage/footer.php');
?>
