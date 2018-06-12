<?php
    include ('affichage/header.php');
    include ('log/pdo.php');

    if(isset($_POST['recherche']) && !empty($_POST['recherche'])) {

        //Création des articles correspondant à la recherche
        $recherche = htmlspecialchars($_POST['recherche']);
        $req = $bdd->prepare('SELECT id FROM articles WHERE titre LIKE :recherche');
        $req->execute(array('recherche'=> '%'.$recherche.'%'));
    }

    //Recherche des lieux à proximité
    if(isset($_GET['latt']) && isset($_GET['long'])){
        $req2 = $bdd->prepare('SELECT * FROM articles');
        $req2->execute();
    }

    //Recherche des lieux à proximité d'après les coordonnées rentrées par l'utilisateur
    if(isset($_POST['longitude']) && isset($_POST['lattitude'])){
        $lat = htmlspecialchars($_POST['lattitude']);
        $long = htmlspecialchars($_POST['longitude']);
        $req3 = $bdd->prepare('SELECT * FROM articles');
        $req3->execute();
    }


    ?>

<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-9">
        <h2>Bienvenu <strong><?php echo $_SESSION['user']; ?></strong></h2>
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
                <table align="center">
                    <tbody>
                    <tr><td>Autour de moi</td></tr>
                    <tr><td><button class="btn btn-primary" onclick="loc()"><span class="glyphicon glyphicon-ok-sign"></span>Rechercher
                                <script> function loc() {

                                        function maPosition(position) {
                                            document.location="acceuil.php?long="+position.coords.longitude+"&latt="+position.coords.latitude;
                                        }
                                        if(navigator.geolocation) {
                                            navigator.geolocation.getCurrentPosition(maPosition);
                                        }

                                    }


                                </script></button></td></tr>
                    </tbody>
                </table>
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
    <div class=" col-lg-12 col-md-12 col-sm-12">
            <!-- Affichage des articles correspondant à la requete dans la barre de recherche-->
            <?php
            if(isset($_POST['recherche']) && !empty($_POST['recherche'])) {
                ?>
                <div class="alert alert-info col-lg-12 col-md-12 col-sm-12">
                    <p>Monuments correspondants à : <strong><?php echo htmlspecialchars($_POST['recherche']);?></strong></p>
                </div>
                <?php
                if($req->rowCount() == 0){
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2>Aucun résultat</h2>
                    </div>
                    <?php
                }
                while ($id = $req->fetch()) {
                    $article = new article($id['id']);
                    ?>
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong><?php echo $article->getTitre(); ?></strong></td>
                            </tr>
                            <tr>
                                <td><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                                         alt="<?php echo $article->getTitre(); ?>" class="img-responsive"></td>
                            </tr>
                            <tr>
                                <td>Lattitude <?php echo $article->getLattitude() ?></td>
                            </tr>
                            <tr>
                                <td>Longitude<?php echo $article->getLongitude() ?></td>
                            </tr>
                            <tr>
                                <td>Description <?php echo $article->getContenu() ?></td>
                            </tr>
                            <tr><td>
                            <form method="post" action="traitement/insertCommentaire.php">
                                <input type="text" name="idArticle" value="<?php echo $monument['id']; ?>"hidden/>
                                <input type="text" name="texte" class="form-control"/>
                                <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-send"></span> Commenter</button>
                            </form>
                                </td></tr>
                        </table>
                    </div>

                    <?php
                }
            }
            //Affichage des articles situés à proximité de l'utilisateur
            else if(isset($_GET['latt']) && isset($_GET['long'])){
                ?>
                <div class="alert alert-info col-lg-12 col-md-12 col-sm-12">
                    <p>Monuments dans un rayon de 10km autour de votre position (LATT:<?php echo $_GET['latt'];?> LONG: <?php echo $_GET['long'];?>)</p>
                </div>
        <?php
                while($monument = $req2->fetch()){
                    $distCalc = new distCalculator($_GET['latt'],$monument['lattitude'],$_GET['long'],$monument['longitude']);
                    $dist = $distCalc->getDist();
                    if($dist < 10){
                        $article = new article($monument['id']);
                        ?>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong><?php echo $article->getTitre(); ?></strong></td>
                                </tr>
                                <tr>
                                    <td><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                                             alt="<?php echo $article->getTitre(); ?>" class="img-responsive"></td>
                                </tr>
                                <tr>
                                    <td>Lattitude <?php echo $article->getLattitude() ?></td>
                                </tr>
                                <tr>
                                    <td>Longitude<?php echo $article->getLongitude() ?></td>
                                </tr>
                                <tr>
                                    <td>Description <?php echo $article->getContenu() ?></td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
            }
            //Affichage des articles situés à proximité des coordonnées rentrées par l'utilisateur
            else if(isset($lat) && isset($long)){
                ?>
                <div class="alert alert-info col-lg-12 col-md-12 col-sm-12">
                    <p>Monuments dans un rayon de 10km autour de LATT:<?php echo $lat;?> LONG: <?php echo $long;?></p>
                </div>
                <?php
                while($monument = $req3->fetch()){
                    $distCalc = new distCalculator($lat,$monument['lattitude'],$long,$monument['longitude']);
                    $dist = $distCalc->getDist();
                    if($dist < 10000){
                        $article = new article($monument['id']);
                        ?>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong><?php echo $article->getTitre(); ?></strong></td>
                                </tr>
                                <tr>
                                    <td><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                                             alt="<?php echo $article->getTitre(); ?>" class="img-responsive"></td>
                                </tr>
                                <tr>
                                    <td>Lattitude <?php echo $article->getLattitude() ?></td>
                                </tr>
                                <tr>
                                    <td>Longitude<?php echo $article->getLongitude() ?></td>
                                </tr>
                                <tr>
                                    <td>Description <?php echo $article->getContenu() ?></td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
            }
            ?>

    </div>
</div>
<?php
include ('affichage/footer.php');
?>