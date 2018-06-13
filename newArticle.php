<?php
include ('affichage/header.php');
?>

    <h2 id="titreNewArticle">Ajouter un article</h2>
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-mg-6 col-sm-offset-3 col-sm-6">
                    <table class="table">
                        <tr class="warning"><td>Veillez vérifier l'exactitude des données avant de valider!</td></tr>
                        <form class="well" method="post" action="traitement/insertArticle.php" enctype="multipart/form-data">
                            <tr><td>Titre <input type="text" name="titre" class="form-control" required/></td></tr>
                            <tr><td>Adresse <input type="text" name="adresse" class="form-control"/></td></tr>
                            <tr><td>Lattitude <input type="text" name="lattitude" class="form-control"/></td></tr>
                            <tr><td>Longitude <input type="text" name="longitude" class="form-control"/></td></tr>
                            <tr><td>Description <textarea name="description" rows="10" cols="50" class="form-control"></textarea></td></tr>
                           <input type="text" name="auteur_id" value="<?php echo $_SESSION['user_id'];?>" class="form-control hidden"/>
                            <tr><td>Photo  <input type="file" name="photo" class="form-control"/></td></tr>
                            <tr><td><button class="btn btn-primary acentrer" type="submit"><span class="glyphicon glyphicon-ok"></span> Valider</button></td></tr>
                        </form>
                    </table>
        </div>
    </div>

<?php
include ('affichage/footer.php');
?>