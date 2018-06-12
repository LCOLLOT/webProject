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
            <h2>Bienvenue <strong><?php echo $_SESSION['user']; ?></strong></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 well-sm well" align="center">

<div class="col-lg-4 col-md-4 col-sm-4">
    <form method="post" action="acceuil.php">
    <table class="table">
        <tr class="tabLigne"><td>Lieu</td></tr>
        <tr><td><input type="text" name="recherche" class="form-control"/></td></tr>
        <tr><td align="center"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Rechercher</button></td></tr>
    </table>
    </form>
</div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <table align="center" class="table">
                    <tbody>
                    <tr class="tabLigne"><td>Autour de moi</td></tr>
                    <tr><td><select name="rayon" class="form-control">
                                <option value="10">10Km</option>

                            </select> </td></tr>
                    <tr><td align="center"><button class="btn btn-primary" onclick="loc()"><span class="glyphicon glyphicon-search"></span> Rechercher
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
                </form>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <form method="post" action="acceuil.php">
                    <table class="table">
                        <tbody>
                        <tr class="tabLigne"><td>Coordonnées GPS</td></tr>
                        <tr><td><div class="col-md-6 col-lg-6 col-sm-6"><input type="text" name="longitude" class="form-control" placeholder="Long"/></div><div class="col-md-6 col-lg-6 col-sm-6"><input type="text" name="lattitude" class="form-control" placeholder="Latt"/></div></td></tr>
                        <tr><td align="center"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Rechercher</button></td></tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
<div class="row">
    <div id="map"></div>
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
                $tabNom = array();
                $tabM = array();
                while ($monument = $req->fetch()) {
                    $article = new article($monument['id']);
                    $tabM[$article->getLongitude()] = $article->getLattitude();
                    $tabNom[] = '"'.$article->getTitre().'"';
                    ?>
                    <div class="item">
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
                                <td>Longitude <?php echo $article->getLongitude() ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $article->getContenu() ?></td>
                            </tr>
                            <tr>
                                <td>Commentaires :</td>
                                    <?php $commentaire = $article->getCommentaires();
                                    foreach ($commentaire as $com){
                                        echo "<tr><td>".$com."</td></tr>";
                                    }
                                    ?>
                            <tr><td>
                                    <form method="post" action="traitement/insertCommentaire.php">
                                        <input type="text" name="idArticle" value="<?php echo $monument['id']; ?>"hidden/>
                                        <input type="text" name="text" class="form-control"/>
                                        <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-send"></span> Commenter</button>
                                    </form>
                            </td></tr>
                            <tr><td>
                                    <form method="post" action="traitement/insertLike.php">
                                        <input type="text" name="idArticle" value="<?php echo $monument['id']; ?>"hidden/>
                                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-thumbs-up"></span></button> <?php echo " : ".$article->getLike()?>
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
                $tabNom = array();
                $tabM = array();
                while($monument = $req2->fetch()){
                    $distCalc = new distCalculator($_GET['latt'],$monument['lattitude'],$_GET['long'],$monument['longitude']);
                    $dist = $distCalc->getDist();
                    if($dist < 10000){
                        $article = new article($monument['id']);
                        $tabM[$monument['longitude']] = $monument['lattitude'];
                        $tabNom[] = '"'.$monument['titre'].'"';
                        ?>
                        <div class="item">
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
                                    <td>Longitude <?php echo $article->getLongitude() ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $article->getContenu() ?></td>
                                </tr>
                                <tr>
                                    <td>Commentaires :</td>
                                    <?php $commentaire = $article->getCommentaires();
                                    foreach ($commentaire as $com){
                                        echo "<tr><td>".$com."</td></tr>";
                                    }
                                    ?>
                                <tr><td>
                                        <form method="post" action="traitement/insertCommentaire.php">
                                            <input type="text" name="idArticle" value="<?php echo $monument['id']; ?>"hidden/>
                                            <input type="text" name="text" class="form-control"/>
                                            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-send"></span> Commenter</button>
                                        </form>
                                    </td></tr>
                                <tr><td>
                                        <form method="post" action="traitement/insertLike.php">
                                            <input type="text" name="idArticle" value="<?php echo $monument['id']; ?>"hidden/>
                                            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-thumbs-up"></span></button> <?php echo " : ".$article->getLike()?>
                                        </form>
                                </td></tr>
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
                $tabNom = array();
                $tabM = array();
                while($monument = $req3->fetch()){
                    $distCalc = new distCalculator($lat,$monument['lattitude'],$long,$monument['longitude']);
                    $dist = $distCalc->getDist();
                    if($dist < 10000){
                        $article = new article($monument['id']);
                        $tabM[$monument['longitude']] = $monument['lattitude'];
                        $tabNom[] = '"'.$monument['titre'].'"';
                        ?>
                        <div class="item">
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
                                    <td>Longitude <?php echo $article->getLongitude() ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $article->getContenu() ?></td>
                                </tr>
                                <tr>
                                    <td>Commentaires :</td>
                                    <?php $commentaire = $article->getCommentaires();
                                    foreach ($commentaire as $com){
                                        echo "<tr><td>".$com."</td></tr>";
                                    }
                                    ?>
                                <tr><td>
                                        <form method="post" action="traitement/insertCommentaire.php">
                                            <input type="text" name="idArticle" value="<?php echo $monument['id']; ?>"hidden/>
                                            <input type="text" name="text" class="form-control"/>
                                            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-send"></span> Commenter</button>
                                        </form>
                                    </td></tr>
                                <tr><td>
                                        <form method="post" action="traitement/insertLike.php">
                                            <input type="text" name="idArticle" value="<?php echo $monument['id']; ?>"hidden/>
                                            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-thumbs-up"></span></button> <?php echo " : ".$article->getLike()?>
                                        </form>
                                </td></tr>
                            </table>
                        </div>
                        <?php
                    }
                }
            }
            ?>

        </div>
    </div>

    <script>
        var map;
        function initMap() {


                var lat = 47.7290842;
                var long = 7.310896100000036;
                <?php if(isset($_GET['latt'])){?>
                lat = <?php echo $_GET['latt']?>;
                long = <?php echo $_GET['long']?>;
                <?php }?>

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: new google.maps.LatLng(lat, long),
                mapTypeId: 'roadmap'
            });

            var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
            var icons = {
                parking: {
                    icon: iconBase + 'parking_lot_maps.png'
                },
                library: {
                    icon: iconBase + 'library_maps.png'
                },
                info: {
                    icon: iconBase + 'info-i_maps.png'
                }
            };

            var features = [
                {
                    position: new google.maps.LatLng(lat, long),
                    type: 'info'
                }
                <?php
                    $i = 0;
                    foreach ($tabM as $long => $latt){
                        ?>,
                            {
                            position: new google.maps.LatLng(<?php echo $latt;?>, <?php echo $long;?>),type: 'info', nom: <?php echo $tabNom[$i];?>
                            }
                        <?php
                    $i++;
                    }
                ?>
            ];

            // Create markers.
            features.forEach(function(feature) {
                var marker = new google.maps.Marker({
                    position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map,
                    label: feature.nom
                });
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN2PTU4JQ2s_Ph8u4bo_pQpvVmlZt2s_Y&callback=initMap" async defer></script>


<?php
include ('affichage/footer.php');
?>