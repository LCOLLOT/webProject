<?php
    include ('affichage/header.php');
    include ('log/pdo.php');

    if(isset($_POST['recherche']) && !empty($_POST['recherche'])) {

        //Création des articles correspondant à la recherche
        $recherche = htmlspecialchars($_POST['recherche']);
        $req = $bdd->prepare('SELECT id FROM articles WHERE titre LIKE :recherche');
        $req->execute(array('recherche'=> '%'.$recherche.'%'));
    }
    ?>

<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-9">
        <h2>Bienvenu monsieur <strong><?php echo $_SESSION['user']; ?></strong></h2>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12" id="searchBarre" align="center">

    <div class="col-lg-3 col-md-3 col-sm-3">
        <form method="post" action="acceuil.php">
            <table align="center">
                <tbody>
                <tr><td>Recherche</td></tr>
                <tr><td><input type="text" name="recherche" class="form-control"/></td></tr>
                <tr><td align="center"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span>Rechercher</button></td></tr>
                </tbody>
            </table>
        </form>
    </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <form method="post" action="acceuil.php">
                <table align="center">
                    <tbody>
                    <tr><td>Autour de moi</td></tr>
                    <tr><td><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span>Rechercher</button></td></tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <form method="post" action="acceuil.php">
                <table>
                    <tbody>
                    <tr>
                        <td>Longitude <input type="text" name="longitude" class="form-control"/></td>
                        <td>Lattitude <input type="text" name="lattitude" class="form-control"/></td>
                    </tr>
                    <tr><td><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span>Rechercher</button></td></tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <br>
    <div class="col-lg-offset-2 col-md-offset-2  col-sm-offset-2  col-lg-10 col-md-10 col-sm-10">
            <!-- Affichage des articles correspondant à la requete dans la barre de recherche-->
            <?php
            if(isset($_POST['recherche']) && !empty($_POST['recherche'])) {
                while ($id = $req->fetch()) {
                    $article = new article($id['id']);
                    ?>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong><?php echo $article->getTitre(); ?></strong></td>
                            </tr>
                            <tr>
                                <td><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                                         alt="<?php echo $article->getTitre(); ?>" class="img-responsive"></td>
                            </tr>
                            <tr>
                                <td><?php echo $article->getCoordonnees() ?></td>
                            </tr>
                        </table>
                    </div>

                    <?php
                }}
            ?>

    </div>


</div>
<?php
include ('affichage/footer.php');
?>