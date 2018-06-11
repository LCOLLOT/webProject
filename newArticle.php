<?php
include ('affichage/header.php');
?>

    <h2>Ajouter un article</h2>
    <div class="row">
        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-5 col-md-5 col-sm-5">
                    <table class="table">
                        <tr class="warning"><td>Veillez vérifier l'exactitude des données avant de valider!</td></tr>
                        <form class="well" method="post" action="traitement/insertArticle.php" enctype="multipart/form-data">
                            <tr><td>Nom <input type="text" name="nom" class="form-control" required/></td></tr>
                            <tr><td>Adresse <input type="text" name="adresse" class="form-control"/></td></tr>
                            <tr><td>Coordonnées <input type="text" name="coordonnees" class="form-control"/></td></tr>
                            <tr><td>Photo  <input type="file" name="photo" class="form-control"/></td></tr>
                            <tr><td><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span>Valider</button></td></tr>
                        </form>
                    </table>
        </div>
    </div>

<?php
include ('affichage/footer.php');
?>