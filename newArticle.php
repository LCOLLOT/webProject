<?php
session_start();
include('affichage/header.php');
?>

    <h2 id="titreNewArticle">Ajouter un article</h2>
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-mg-6 col-sm-offset-3 col-sm-6">

            <h4> Veillez vérifier l'exactitude des données avant de valider!</h4>
                <form class="well" method="post" action="traitement/insertArticle.php" enctype="multipart/form-data">
                    <table class="table">
                    <tr><td>Titre <input type="text" name="titre" class="form-control" required/></td></tr>
                    <tr><td>Adresse <input type="text" name="adresse" class="form-control"/></td></tr>
                    <tr><td>Lattitude <input type="text" name="lattitude" class="form-control"/></td></tr>
                    <tr><td>Longitude <input type="text" name="longitude" class="form-control"/></td></tr>
                    <tr><td>Description <textarea name="description" rows="10" cols="50" class="form-control"></textarea></td></tr>
                    <tr><td><input type="text" name="auteur_id" value="<?php echo $_SESSION['user_id'];?>" class="form-control hidden"/></td></tr>
                    <tr><td>Photo  <input type="file" name="photo" class="form-control"/></td></tr>
                    <tr><td>Catégorie<br />
                            <select name="choix" class="form-control">
                                <option value="Musée">Musée</option>
                                <option value="Châteaux">Châteaux</option>
                                <option value="Grotte">Grotte</option>
                                <option value="Monument religieux">Monument religieux</option>
                                <option value="Autre monument historique">Autre monument historique</option>
                            </select>
                    </td></tr>
                    <tr><td><button class="btn btn-primary acentrer" type="submit"><span class="glyphicon glyphicon-ok"></span> Valider</button></td></tr>
                    </table>
                </form>
        </div>
    </div>
<?php
include('affichage/footer.php');
?>