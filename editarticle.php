<?php
session_cache_limiter('private_no_expire, must-revalidate');
include ('log/pdo.php');
include ('object/Profil.php');

if (!isset($_SESSION) || !isset($_SESSION["user_id"]))
{
    header("Location: index.php");
    exit();
}
$userId = $_SESSION["user_id"];
$profil = new Profil($userId);

if ($profil->getGroupe() != "admin" && $profil->getGroupe() != "moderateur")
{
    http_response_code(403);
    echo "Page interdite w4nn4-83-h4x0r";
    exit();
}

require 'object/article.php';
require 'object/distCalculator.php';
?>
    <!doctype html>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Web-Trotter</title>
        <link rel="stylesheet" href="add.css" />
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    </head>

<body>
    <div class="row">
        <div id="titreHead">
            <h1>Web-Trotter</h1>
        </div>
    </div>
    <!-- Ceci est mon corps -->
    <img src="images/back.png" alt="monuments" class="img-responsive">
    <nav class="navbar navbar-inverse" id="barreNav">
        <div class="pull-left">
            <a href="acceuil.php"><img src="images/logo.png" alt="web-trotter" class="logo"></a>
        </div>
        <ul class="nav navbar-nav">
            <!--<li> </li>-->
            <li> <a href="acceuil.php">Accueil</a> </li>
            <li> <a href="newArticle.php">Ajouter un lieu</a> </li>
            <li> <a href="contact.php">Contact</a> </li>
        </ul>
        <div class="pull-right" id="buttonH">
            <?php if (isset($_SESSION['user'])) { ?>
                <div class="btn btn-default disabled" style="cursor:default;"><span class="glyphicon glyphicon-check"></span> <?php echo $_SESSION['user']; ?>, <?php echo $profil->getGroupe(); ?> </div>
            <?php } ?>

            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Compte <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="profil.php"><span class="glyphicon glyphicon-user"></span> Mon profil</a></li>
                <li><a href="contributions.php"><span class="glyphicon glyphicon-picture"></span> Mes Contributions</a></li>
                <li><a href="messagerie.php"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
                <?php
                if ($profil->getGroupe() == "moderateur" || $profil->getGroupe() == "admin" )
                {
                    echo "<li class=\"divider\"></li>";
                    echo "<li> <a href=\"editarticle.php\"><span class=\"glyphicon glyphicon-wrench\"></span> Modération</a> </li>";
                } ?>
                <?php
                if ($profil->getGroupe() == "admin")
                {
                    echo "<li> <a href=\"admin.php\"><span class=\"glyphicon glyphicon-console\"></span> Panel Admin</a> </li>";
                } ?>
                <li class="divider"></li>
                <li><a href="index.php?disconnect=true"><span class="glyphicon glyphicon-log-in"></span> Se Déconnecter</a></li>
            </ul>
        </div>
    </nav>
<div class="container">
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


    <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Signalements</a>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Edition d'article</button>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Afficher les deux</button>
    </p>
    <div class="row">
        <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <?php

                    $reqsignal = $bdd->query('SELECT * FROM articles, signalement WHERE signalement.article_id = articles.id ');

                    while ($signalements = $reqsignal->fetch())
                    {
                        $article = new article($signalements['article_id']);

                        ?>
                        <form method="post" action="updateArticle.php">
                            <input type="hidden" name="id" value="<?php echo $article->getId();?>">
                            <div>
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th class="col-md-1">ID Signalés</th>
                                        <th class="col-md-2">Auteur</th>
                                        <th class="col-md-5">Titre</th>
                                        <th class="col-md-2">Latitude</th>
                                        <th class="col-md-2">Longitude</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $article->getId(); ?></td>
                                        <td><?php echo $article->getAuteur(); ?></td>
                                        <td><input style="width: 100%" type="text" name="titre" value="<?php echo $article->getTitre(); ?>"/></td>
                                        <td><input style="width: 100%" type="text" name="latitude" value="<?php echo $article->getLattitude(); ?>"/></td>
                                        <td><input style="width: 100%" type="text" name="longitude" value="<?php echo $article->getLongitude(); ?>"/></td>
                                    </tr>
                                </table>
                                Description
                                <textarea style="resize: vertical;" name="description" rows="4" cols="70" class="form-control"><?php echo $article->getContenu(); ?></textarea>
                                <div style="float: right;">
                                    <button class="btn btn-primary" name="UpdateSignal"><span class="glyphicon glyphicon-ok"></span></button>
                                    <button class="btn btn-danger" name="Delete" onclick="return confirm('Supprimer l\'article <?php echo $article->getTitre(); ?> ?')"><span class="glyphicon glyphicon-remove"></span></button>
                                </div>
                                <br>
                                <br>
                            </div>
                        </form>
                        <br>
                        <?php
                    }
                    $reqsignal->closeCursor();
                    ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample2">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 well-sm well">

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <form method="post" action="editarticle.php">
                                    <h3>Lieu</h3>
                                    <input type="text" name="recherche" class="form-control" placeholder="Tapez une indication du lieu ici"/>
                                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php
    if(isset($_POST['recherche']) && !empty($_POST['recherche']))
    {

        $recherche = htmlspecialchars($_POST['recherche']);
        $req = $bdd->prepare('SELECT id FROM articles WHERE titre LIKE :recherche ORDER BY id DESC');

        $req->execute(array('recherche'=> '%'.$recherche.'%'));

        while ($data = $req->fetch())
        {
            $article = new article($data['id']);

            ?>
            <form method="post" action="updateArticle.php">
                <input type="hidden" name="id" value="<?php echo $article->getId();?>">
                <div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th class="col-md-2">Auteur</th>
                            <th class="col-md-5">Titre</th>
                            <th class="col-md-2">Latitude</th>
                            <th class="col-md-2">Longitude</th>
                        </tr>
                        <tr>
                            <td><?php echo $article->getId(); ?></td>
                            <td><?php echo $article->getAuteur(); ?></td>
                            <td><input style="width: 100%" type="text" name="titre" value="<?php echo $article->getTitre(); ?>"/></td>
                            <td><input style="width: 100%" type="text" name="latitude" value="<?php echo $article->getLattitude(); ?>"/></td>
                            <td><input style="width: 100%" type="text" name="longitude" value="<?php echo $article->getLongitude(); ?>"/></td>
                        </tr>
                    </table>
                    Description
                    <textarea style="resize: vertical;" name="description" rows="4" cols="70" class="form-control"><?php echo $article->getContenu(); ?></textarea>
                    <div style="float: right;">
                         <button class="btn btn-primary" name="Update"><span class="glyphicon glyphicon-ok"></span></button>
                         <button class="btn btn-danger" name="Delete" onclick="return confirm('Supprimer l\'article <?php echo $article->getTitre(); ?> ?')"><span class="glyphicon glyphicon-remove"></span></button>
                    </div>
                    <br>
                    <br>
                </div>
            </form>
            <br>
            <?php
        }
        $req->closeCursor();
    }
?>

<?php
include ('affichage/footer.php');
?>