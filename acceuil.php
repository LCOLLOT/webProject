<?php
include ('affichage/header.php');
include('log/pdo.php');

if(isset($_GET['article'])){
    $req5 = $bdd->prepare('SELECT id FROM articles WHERE id = :id');
    $req5->execute(array('id'=> htmlspecialchars($_GET['article'])));
}
if(isset($_POST['recherche']) && !empty($_POST['recherche'])) {
    $_SESSION['recherche'] = htmlspecialchars($_POST['recherche']);
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
//Recherche des 5 lieux les plus likés
$req4 = $bdd->prepare('SELECT article_id AS id FROM likearticle GROUP BY article_id ORDER BY COUNT(article_id) ASC LIMIT 0,5');
$req4->execute();


?>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9">
            <h2>Bienvenue <strong><?php echo $_SESSION['user']; ?></strong></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 well-sm well">

            <div class="col-lg-4 col-md-4 col-sm-4">
                <form method="post" action="acceuil.php">
                            <h3>Lieu</h3>
        <input type="text" name="recherche" class="form-control" placeholder="Tapez une indication du lieu ici"/>
                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <form name="rayonF">
                            <h3>Autour de moi</h3>
                            <select name="rayon" class="form-control">
                                    <option value="10000">10Km</option>
                                    <option value="20000">20Km</option>
                                    <option value="50000">50Km</option>
                                    <option value="100000">100Km</option>

                                </select>
                                    <script> function loc() {

                                            function maPosition(position) {
                                                document.location = "acceuil.php?long=" + position.coords.longitude + "&latt=" + position.coords.latitude+"&ray="+document.forms["rayonF"].elements["rayon"].value;
                                            }

                                            if (navigator.geolocation) {
                                                navigator.geolocation.getCurrentPosition(maPosition);
                                            }

                                        }
                                    </script>
                </form>
                <button class="btn btn-primary" onclick="loc()"><span class="glyphicon glyphicon-search"></span></button>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <form method="post" action="acceuil.php">
                            <h3>Coordonnées GPS</h3>
                                <div class="col-md-6 col-lg-6 col-sm-6"><input type="text" name="longitude" class="form-control" placeholder="Longitude"/>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6"><input type="text" name="lattitude" class="form-control" placeholder="Latitude"/>
                                </div>
                                <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="map"></div>
    </div>
    <div class="row">
        <br>
        <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-10 col-md-10 col-sm-10">
            <?php
            if(isset($_GET['article'])){
            $tabNom = array();
            $tabM = array();
            $tabDescriptif = array();
            $first = true;
            while ($monument = $req5->fetch()) {
                $article = new article($monument['id']);
                $tabM[$article->getLongitude()] = $article->getLattitude();
                $tabNom[] = '"' . $article->getTitre() . '"';
                $tabDescriptif[] = '"' .$article->getUniqueCommentaire() . '"';
                ?>
                <div class="item <?php if ($first == true) echo "active"; ?>">
                    <div class="art">
                        <h4><strong><?php echo $article->getTitre()." : ".$article->getCategorie(); ?></strong></h4>
                        <p><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                                alt="<?php echo $article->getTitre(); ?>" class="img-responsive" style="max-height: 200px"></p>
                        <p> Rédigé par <a href="newMessage.php?dest=<?php echo $article->getAuteur();?>&artId=<?php echo $monument['id'];?>"><?php echo $article->getAuteur();?></a></p>
                        <div class="row">
                            <div class="boxCord">
                                <p class="form-control">LATT : <?php echo $article->getLattitude() ?></p>
                                <p class="form-control">LONG : <?php echo $article->getLongitude() ?></p>
                            </div>
                            <div class="imgCord">
                                <img src="images/boxCord.png" alt="GPS" class="img-responsive"/>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 contenuBox">
                                <p><?php echo $article->getContenu() ?></p>
                            </div>
                        </div>

                        <h4>Commentaires</h4>
                        <?php $commentaire = $article->getCommentaires();
                        foreach ($commentaire as $id => $com) {
                            ?>
                            <div class="unitComment">
                                <span class="glyphicon glyphicon-chevron-right"></span><?php echo $com?>
                                <button class="btn btn-sm btn-default btn_LikeC <?php if($article->isLiked($_SESSION['user_id'])) echo 'activeLike';?>" id="LC<?php  echo $id;?>" <?php if($article->isLikedC($id ,$_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"> <?php echo $article->getNbLikeCommentaire($id);?></span></button>
                            </div>
                            <?php
                        }
                        ?>
                        <tr>
                            <td>
                                <form method="post" action="traitement/insertCommentaire.php">
                                    <input type="text" name="idArticle"
                                           value="<?php echo $monument['id']; ?>" hidden/>
                                    <input type="text" name="text" class="form-control"/>
                                    <button class="btn btn-primary" type="submit"><span
                                                class="glyphicon glyphicon-send"></span> Commenter
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </table>

                    <button class="btn btn-sm btn-default btn_Like <?php if($article->isLiked($_SESSION['user_id'])) echo 'activeLike';?>" id="L<?php echo $article->getId();?>" <?php if($article->isLiked($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"> <?php echo $article->getLike()?></span></button>
                    <button class="btn btn-sm btn-default btn_Dislike <?php if($article->isDisliked($_SESSION['user_id'])) echo 'activeDislike';?>" id="D<?php echo $article->getId();?>" <?php if($article->isDisliked($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-down"> <?php echo $article->getDislike()?></span></button>
                    <button class="btn btn-sm btn-default btn_Sign <?php if($article->isSignaled($_SESSION['user_id'])) echo 'activeSign';?>" id="S<?php echo $article->getId();?>" <?php if($article->isSignaled($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-warning-sign"></span></button>

                </div>
                </div>
                <?php
                $first = false;
            } ?>
            <a class="left carousel-control" href="#carousel" data-slide="prev" style="background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%); height: 30px;"><span
                        class="icon-prev"></span></a>
            <a class="right carousel-control" href="#carousel" data-slide="next" style="background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%); height: 30px;"><span
                        class="icon-next"></span></a>
        </div>
    </div>

    <?php
}
else if (isset($_POST['recherche']) && !empty($_POST['recherche'])) {
    ?>

        <h3>Monuments correspondants à :<strong><?php echo htmlspecialchars($_POST['recherche']); ?></strong></h3>
    <?php
    if ($req->rowCount() == 0) {
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2>Aucun résultat</h2>
        </div>

        <?php
    } ?>

    <div class="carousel slide" id="carousel" data-ride="carousel">
        <div class="carousel-inner thumbnail">
            <?php
            $tabNom = array();
            $tabM = array();
            $tabDescriptif = array();
            $first = true;
            while ($monument = $req->fetch()) {
                $article = new article($monument['id']);
                $tabM[$article->getLongitude()] = $article->getLattitude();
                $tabNom[] = '"' . $article->getTitre() . '"';
                $tabDescriptif[] = '"' .$article->getUniqueCommentaire() . '"';
                ?>
                <div class="item <?php if ($first == true) echo "active"; ?>">
                    <div class="art">
                            <h4><strong><?php echo $article->getTitre()." : ".$article->getCategorie(); ?></strong></h4>
                            <p><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                                     alt="<?php echo $article->getTitre(); ?>" class="img-responsive" style="max-height: 200px"></p>
                            <p> Rédigé par <a href="newMessage.php?dest=<?php echo $article->getAuteur();?>&artId=<?php echo $monument['id'];?>"><?php echo $article->getAuteur();?></a></p>
                        <div class="row">
                        <div class="boxCord">
                            <p class="form-control">LATT : <?php echo $article->getLattitude() ?></p>
                            <p class="form-control">LONG : <?php echo $article->getLongitude() ?></p>
                        </div>
                        <div class="imgCord">
                            <img src="images/boxCord.png" alt="GPS" class="img-responsive"/>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 contenuBox">
                            <p><?php echo $article->getContenu() ?></p>
                        </div>
                        </div>

                            <h4>Commentaires</h4>
                            <?php $commentaire = $article->getCommentaires();
                            foreach ($commentaire as $id => $com) {
                            ?>
                                <div class="unitComment">
                                <span class="glyphicon glyphicon-chevron-right"></span><?php echo $com?>
                                <button class="btn btn-sm btn-default btn_LikeC <?php if($article->isLiked($_SESSION['user_id'])) echo 'activeLike';?>" id="LC<?php  echo $id;?>" <?php if($article->isLikedC($id ,$_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"> <?php echo $article->getNbLikeCommentaire($id);?></span></button>
                                </div>
                        <?php
                        }
                        ?>

                                <form method="post" action="traitement/insertCommentaire.php">
                                    <input type="text" name="idArticle"
                                           value="<?php echo $monument['id']; ?>" hidden/>
                                    <input type="text" name="text" class="form-control"/>
                                    <button class="btn btn-primary" type="submit"><span
                                                class="glyphicon glyphicon-send"></span> Commenter
                                    </button>
                                </form>

                    <button class="btn btn-sm btn-default btn_Like <?php if($article->isLiked($_SESSION['user_id'])) echo 'activeLike';?>" id="L<?php echo $article->getId();?>" <?php if($article->isLiked($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"> <?php echo $article->getLike()?></span></button>
                    <button class="btn btn-sm btn-default btn_Dislike <?php if($article->isDisliked($_SESSION['user_id'])) echo 'activeDislike';?>" id="D<?php echo $article->getId();?>" <?php if($article->isDisliked($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-down"> <?php echo $article->getDislike()?></span></button>
                    <button class="btn btn-sm btn-default btn_Sign <?php if($article->isSignaled($_SESSION['user_id'])) echo 'activeSign';?>" id="S<?php echo $article->getId();?>" <?php if($article->isSignaled($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-warning-sign"></span></button>
                </div>
                </div>
                <?php
                $first = false;
            } ?>
            <a class="left carousel-control" href="#carousel" data-slide="prev" style="background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%); height: 30px;"><span
                        class="glyphicon glyphicon-menu-left black"></span></a>
            <a class="right carousel-control" href="#carousel" data-slide="next" style="background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%); height: 30px;"><span
                        class="glyphicon glyphicon-menu-right black"></span></a>
        </div>
    </div>
    <?php
} //Affichage des articles situés à proximité de l'utilisateur
else if (isset($_GET['latt']) && isset($_GET['long'])){
    ?>
    <div class="alert alert-info col-lg-12 col-md-12 col-sm-12">
        <p>Monuments dans un rayon de <?php echo $_GET['ray']/1000;?>km autour de votre position (LATT:<?php echo $_GET['latt']; ?>
            LONG: <?php echo $_GET['long']; ?>)</p>
    </div>
    <div class="carousel slide" id="carousel" data-ride="carousel">
        <div class="carousel-inner thumbnail">
            <?php
            $tabNom = array();
            $tabM = array();
            $tabDescriptif = array();
            $first = true;
            while ($monument = $req2->fetch()) {
                $distCalc = new distCalculator($_GET['latt'], $monument['lattitude'], $_GET['long'], $monument['longitude']);
                $dist = $distCalc->getDist();
                if ($dist < $_GET['ray']) {
                    $article = new article($monument['id']);
                    $tabM[$monument['longitude']] = $monument['lattitude'];
                    $tabNom[] = '"' . $monument['titre'] . '"';
                    $tabDescriptif[] = '"' .$article->getUniqueCommentaire() . '"';
                    ?>
                    <div class="item <?php if ($first == true) echo "active"; ?>">
                        <div class="art">
                            <h4><strong><?php echo $article->getTitre()." : ".$article->getCategorie(); ?></strong></h4>
                            <p><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                                    alt="<?php echo $article->getTitre(); ?>" class="img-responsive" style="max-height: 200px"></p>
                            <p> Rédigé par <a href="newMessage.php?dest=<?php echo $article->getAuteur();?>&artId=<?php echo $monument['id'];?>"><?php echo $article->getAuteur();?></a></p>
                            <div class="row">
                                <div class="boxCord">
                                    <p class="form-control">LATT : <?php echo $article->getLattitude() ?></p>
                                    <p class="form-control">LONG : <?php echo $article->getLongitude() ?></p>
                                </div>
                                <div class="imgCord">
                                    <img src="images/boxCord.png" alt="GPS" class="img-responsive"/>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 contenuBox">
                                    <p><?php echo $article->getContenu() ?></p>
                                </div>
                            </div>

                            <h4>Commentaires</h4>
                            <?php $commentaire = $article->getCommentaires();
                            foreach ($commentaire as $id => $com) {
                                ?>
                                <div class="unitComment">
                                    <span class="glyphicon glyphicon-chevron-right"></span><?php echo $com?>
                                    <button class="btn btn-sm btn-default btn_LikeC <?php if($article->isLiked($_SESSION['user_id'])) echo 'activeLike';?>" id="LC<?php  echo $id;?>" <?php if($article->isLikedC($id ,$_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"> <?php echo $article->getNbLikeCommentaire($id);?></span></button>
                                </div>
                                <?php
                            }
                            ?>
                            <tr>
                                <td>
                                    <form method="post" action="traitement/insertCommentaire.php">
                                        <input type="text" name="idArticle"
                                               value="<?php echo $monument['id']; ?>" hidden/>
                                        <input type="text" name="text" class="form-control"/>
                                        <button class="btn btn-primary" type="submit"><span
                                                    class="glyphicon glyphicon-send"></span> Commenter
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        <button class="btn btn-sm btn-default btn_Like <?php if($article->isLiked($_SESSION['user_id'])) echo 'activeLike';?>" id="L<?php echo $article->getId();?>" <?php if($article->isLiked($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"> <?php echo $article->getLike()?></span></button>
                        <button class="btn btn-sm btn-default btn_Dislike <?php if($article->isDisliked($_SESSION['user_id'])) echo 'activeDislike';?>" id="D<?php echo $article->getId();?>" <?php if($article->isDisliked($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-down"> <?php echo $article->getDislike()?></span></button>
                        <button class="btn btn-sm btn-default btn_Sign <?php if($article->isSignaled($_SESSION['user_id'])) echo 'activeSign';?>" id="S<?php echo $article->getId();?>" <?php if($article->isSignaled($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-warning-sign"></span></button>
                    </div>
                    </div>
                    <?php
                    $first = false;
                }
            } ?>
            <a class="left carousel-control" href="#carousel" data-slide="prev" style="background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%); height: 30px;">
                <span class="glyphicon glyphicon-menu-left black" aria-hidden="true" href="#carousel" data-slide="prev"></span>
            </a>
            <a class="right carousel-control" href="#carousel" data-slide="next" style="background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%); height: 30px;">
                <span class="glyphicon glyphicon-menu-right black" aria-hidden="true"></span>
            </a>
        </div>
    </div>
    <?php
} //Affichage des articles situés à proximité des coordonnées rentrées par l'utilisateur
else if (isset($lat) && isset($long)){
    ?>
    <div class="alert alert-info col-lg-12 col-md-12 col-sm-12">
        <p>Monuments dans un rayon de 10km autour de LATT:<?php echo $lat; ?> LONG: <?php echo $long; ?></p>
    </div>
    <div class="carousel slide" id="carousel" data-ride="carousel">
        <div class="carousel-inner thumbnail">
            <?php
            $tabNom = array();
            $tabM = array();
            $tabDescriptif = array();
            $first = true;
            while ($monument = $req3->fetch()) {
                $distCalc = new distCalculator($lat, $monument['lattitude'], $long, $monument['longitude']);
                $dist = $distCalc->getDist();
                if ($dist < 10000) {
                    $article = new article($monument['id']);
                    $tabM[$monument['longitude']] = $monument['lattitude'];
                    $tabNom[] = '"' . $monument['titre'] . '"';
                    $tabDescriptif[] = '"' .$article->getUniqueCommentaire() . '"';
                    ?>
                    <div class="item <?php if ($first == true) echo "active"; ?>">
                        <div class="art">
                            <h4><strong><?php echo $article->getTitre()." : ".$article->getCategorie(); ?></strong></h4>
                            <p><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                                    alt="<?php echo $article->getTitre(); ?>" class="img-responsive" style="max-height: 200px"></p>
                            <p> Rédigé par <a href="newMessage.php?dest=<?php echo $article->getAuteur();?>&artId=<?php echo $monument['id'];?>"><?php echo $article->getAuteur();?></a></p>
                            <div class="row">
                                <div class="boxCord">
                                    <p class="form-control">LATT : <?php echo $article->getLattitude() ?></p>
                                    <p class="form-control">LONG : <?php echo $article->getLongitude() ?></p>
                                </div>
                                <div class="imgCord">
                                    <img src="images/boxCord.png" alt="GPS" class="img-responsive"/>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 contenuBox">
                                    <p><?php echo $article->getContenu() ?></p>
                                </div>
                            </div>

                            <h4>Commentaires</h4>
                            <?php $commentaire = $article->getCommentaires();
                            foreach ($commentaire as $id => $com) {
                                ?>
                                <div class="unitComment">
                                    <span class="glyphicon glyphicon-chevron-right"></span><?php echo $com?>
                                    <button class="btn btn-sm btn-default btn_LikeC <?php if($article->isLiked($_SESSION['user_id'])) echo 'activeLike';?>" id="LC<?php  echo $id;?>" <?php if($article->isLikedC($id ,$_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"> <?php echo $article->getNbLikeCommentaire($id);?></span></button>
                                </div>
                                <?php
                            }
                            ?>
                            <tr>
                                <td>
                                    <form method="post" action="traitement/insertCommentaire.php">
                                        <input type="text" name="idArticle"
                                               value="<?php echo $monument['id']; ?>" hidden/>
                                        <input type="text" name="text" class="form-control"/>
                                        <button class="btn btn-primary" type="submit"><span
                                                    class="glyphicon glyphicon-send"></span> Commenter
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        <button class="btn_Like" id="L<?php echo $article->getId();?>" <?php if($article->isLiked($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"> <?php echo $article->getLike()?></span></button>
                        <button class="btn_Dislike" id="D<?php echo $article->getId();?>" <?php if($article->isDisliked($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-down"> <?php echo $article->getDislike()?></span></button>
                        <button class="btn_Sign" id="S<?php echo $article->getId();?>" <?php if($article->isSignaled($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-warning-sign"></span></button>
                    </div>
                    </div>
                    <?php
                    $first = false;
                }
            }
            ?>
            <a class="left carousel-control" href="#carousel" data-slide="prev" style="background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%); height: 30px;"><span
                        class="glyphicon glyphicon-menu-left black"></span></a>
            <a class="right carousel-control" href="#carousel" data-slide="next" style="background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%); height: 30px;"><span
                        class="glyphicon glyphicon-menu-right black"></span></a>
        </div>
    </div>
<?php } //Affichage des 5 articles les plus convoités
else if(!($_POST['recherche'] && !empty($_POST['recherche'])) && !(isset($lat) && isset($long)) && !(isset($_POST['recherche']) && !empty($_POST['recherche'])) ) {?>
    <div class="alert alert-info col-lg-12 col-md-12 col-sm-12">
        <p id ="mostliked">Les 5 monuments les plus appréciés :</p>
    </div>
    <div class="carousel slide" id="carousel" data-ride="carousel">
        <div class="carousel-inner thumbnail">
            <?php
            $tabNom = array();
            $tabM = array();
            $tabDescriptif = array();
            $first = true;
            while ($monument = $req4->fetch()) {
                $article = new article($monument['id']);
                $tabM[$article->getLongitude()] = $article->getLattitude();
                $tabNom[] = '"' . $article->getTitre() . '"';
                $tabDescriptif[] = '"' .$article->getUniqueCommentaire() . '"';
                ?>
                <div class="item <?php if ($first == true) echo "active"; ?>">
                    <div class="art">
                        <h4><strong><?php echo $article->getTitre()." : ".$article->getCategorie(); ?></strong></h4>
                        <p><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                                alt="<?php echo $article->getTitre(); ?>" class="img-responsive" style="max-height: 200px"></p>
                        <p> Rédigé par <a href="newMessage.php?dest=<?php echo $article->getAuteur();?>&artId=<?php echo $monument['id'];?>"><?php echo $article->getAuteur();?></a></p>
                        <div class="row">
                            <div class="boxCord">
                                <p class="form-control">LATT : <?php echo $article->getLattitude() ?></p>
                                <p class="form-control">LONG : <?php echo $article->getLongitude() ?></p>
                            </div>
                            <div class="imgCord">
                                <img src="images/boxCord.png" alt="GPS" class="img-responsive"/>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 contenuBox">
                                <p><?php echo $article->getContenu() ?></p>
                            </div>
                        </div>

                        <h4>Commentaires</h4>
                        <?php $commentaire = $article->getCommentaires();
                        foreach ($commentaire as $id => $com) {
                            ?>
                            <div class="unitComment">
                                <span class="glyphicon glyphicon-chevron-right"></span><?php echo $com?>
                                <button class="btn btn-sm btn-default btn_LikeC <?php if($article->isLiked($_SESSION['user_id'])) echo 'activeLike';?>" id="LC<?php  echo $id;?>" <?php if($article->isLikedC($id ,$_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"> <?php echo $article->getNbLikeCommentaire($id);?></span></button>
                            </div>
                            <?php
                        }
                        ?>
                        <tr>
                            <td>
                                <form method="post" action="traitement/insertCommentaire.php">
                                    <input type="text" name="idArticle"
                                           value="<?php echo $monument['id']; ?>" hidden/>
                                    <input type="text" name="text" class="form-control"/>
                                    <button class="btn btn-primary" type="submit"><span
                                                class="glyphicon glyphicon-send"></span> Commenter
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </table>
                    <button class="btn btn-sm btn-default btn_Like <?php if($article->isLiked($_SESSION['user_id'])) echo 'activeLike';?>" id="L<?php echo $article->getId();?>" <?php if($article->isLiked($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"> <?php echo $article->getLike()?></span></button>
                    <button class="btn btn-sm btn-default btn_Dislike <?php if($article->isDisliked($_SESSION['user_id'])) echo 'activeDislike';?>" id="D<?php echo $article->getId();?>" <?php if($article->isDisliked($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-down"> <?php echo $article->getDislike()?></span></button>
                    <button class="btn btn-sm btn-default btn_Sign <?php if($article->isSignaled($_SESSION['user_id'])) echo 'activeSign';?>" id="S<?php echo $article->getId();?>" <?php if($article->isSignaled($_SESSION['user_id'])) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-warning-sign"></span></button>
                </div>
                </div>
                <?php
                $first = false;
            } ?>
            <a class="left carousel-control" href="#carousel" data-slide="prev" style="background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%); height: 30px;"><span
                        class="glyphicon glyphicon-menu-left black"></span></a>
            <a class="right carousel-control" href="#carousel" data-slide="next" style="background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%); height: 30px;"><span
                        class="glyphicon glyphicon-menu-right black"></span></a>
        </div>

    </div>
<?php } ?>
    </div>
    </div>

    <script>
        var map;

        function initMap() {
            var lat = 47.7290842;
            var long = 7.3108961;
            var texte ='Votre position';
            <?php if(isset($_GET['latt'])){?>
            lat = <?php echo $_GET['latt']?>;
            long = <?php echo $_GET['long']?>;
            <?php } else if(isset($_POST['lattitude']) && isset($_POST['longitude'])){?>
            lat = <?php echo htmlspecialchars($_POST['lattitude']);?>;
            long = <?php echo htmlspecialchars($_POST['longitude'])?>;
            text = 'Lieu recherché';
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
                    type: 'info',
                    nom: texte
                }
                <?php
                $i = 0;
                foreach ($tabM as $long => $latt){
                ?>,
                {
                    position: new google.maps.LatLng(<?php echo $latt;?>, <?php echo $long;?>),
                    type: 'info',
                    nom: <?php echo $tabNom[$i];?>,
                    text: <?php echo $tabDescriptif[$i];?>
                }
                <?php
                $i++;
                }
                ?>
            ];

            // Create markers.
            features.forEach(function (feature) {
                var marker = new google.maps.Marker({
                    position: feature.position,
                    icon: icons[feature.type].icon,
                    map: map,
                    label: feature.nom
                });

                var infowindow = new google.maps.InfoWindow({
                    content: feature.text
                });

                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN2PTU4JQ2s_Ph8u4bo_pQpvVmlZt2s_Y&callback=initMap" async defer></script>
    <script>
        $(function () {
            $('.carousel').carousel();
        });
    </script>

    <script>
        $('.btn_Like').click(function(e) {
            var id = $(e.currentTarget).attr('id');
            id = id.substring(1);
            $.ajax({
                url : 'traitement/insertLike.php', // La ressource ciblée
                type : 'GET', // Le type de la requête HTTP.
                data : 'idLike=' + id,
                success : function(htmlcode, statut) {
                    $('#L'+id).addClass('activeLike').attr("disabled", true).children('span').text(" J'aime");
                }
            });
            return false;
        });
        $('.btn_Dislike').click(function(e) {
            var id = $(e.currentTarget).attr('id');
            id = id.substring(1);
            $.ajax({
                url : 'traitement/insertLike.php', // La ressource ciblée
                type : 'GET', // Le type de la requête HTTP.
                data : 'idDislike=' + id,
                success : function(htmlcode, statut) {
                    $('#D'+id).addClass('activeDislike').attr("disabled", true).children('span').text(" J'aime pas");
                }
            });
            return false;
        });
        $('.btn_Sign').click(function(e) {
            var id = $(e.currentTarget).attr('id');
            id = id.substring(1);
            $.ajax({
                url : 'traitement/insertLike.php', // La ressource ciblée
                type : 'GET', // Le type de la requête HTTP.
                data : 'idSignal=' + id,
                success : function(htmlcode, statut) {
                    $('#S'+id).addClass('activeSign').attr("disabled", true);
                }
            });
            return false;
        });
        $('.btn_LikeC').click(function(e) {
            var id = $(e.currentTarget).attr('id');
            id = id.substring(2);
            $.ajax({
                url : 'traitement/insertLikeCommentaire.php', // La ressource ciblée
                type : 'GET', // Le type de la requête HTTP.
                data : 'idCom=' + id,
                success : function(htmlcode, statut) {
                    $('#LC'+id).addClass('activeLike').attr("disabled", true).children('span').text(" J'aime");
                }
            });
            return false;
        });
    </script>
<?php
include('affichage/footer.php');
?>