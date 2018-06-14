<?php
    require 'log/loginManager.php';

    $login = "";
    $mdp = "";
    if (isset($_POST['login'])) {
        $login = htmlspecialchars($_POST['login']);
        $mdp = htmlspecialchars($_POST['password']);
    }

    $LoginManager = new loginManager();
    $user = $LoginManager->getUser($login, $mdp);
    $user_id = $LoginManager->getUserId($login, $mdp);


if (isset($_GET['disconnect']))
{
    $user="disconnect";
    session_destroy();

}

    if(isset($user) && $user != "badLog" && $user != "disconnect"){
        $_SESSION['user'] = $user;
        $_SESSION['user_id'] = $user_id;
        header("Location: acceuil.php");
        exit();
    }

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
<!-- COMMENTAIRE : ici, je place le corps de mon site -->
<div class="row">
    <div id="titreHead">
        <h1>Web-Trotter</h1>
    </div>
</div>
<!-- COMMENTAIRE : ici, je place le corps de mon site -->
<img src="images/back.jpg" alt="informatique" class="img-responsive">
<nav class="navbar navbar-inverse" id="barreNav">
    <div class="pull-left">
        <a href="acceuil.php"><img src="images/logo.png" alt="web-trotter" class="logo"></a>
    </div>
    <div class="pull-right">
        <button class="btn btn-lg btn-default" data-toggle="modal" href="#infosSite" data-backdrop="false" ><span class="glyphicon glyphicon-info-sign"></span></button>
        <button class="btn btn-lg btn-info" data-toggle="modal" href="#infos" data-backdrop="false" >S'inscrire</button>
    </div>
</nav>
<div class="indexcontainer">
    <!--<a href="acceuil.php"><img src="images/logo.png" alt="web-trotter" class="inscriptionlogo"></a>-->
        <ul class="nav navbar-nav">
            <li></li>
        </ul>

    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
<div class="row" id="lignForm">
    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-lg-4 col-md-4 col-sm-4" id="formLog">
        <form action="index.php" method="post">
            <table class="table">
                <tr><td><span class="label label-default">E-mail</span><input type="text" class="form-control" name="login" title="Saisie d'un identifiant"></td></tr>
                <tr><td><span class="label label-default">Mot de passe</span><input type="password" class="form-control" name="password" title="Saisie du mot de passe"></td></tr>
                <tr><td class="button-td"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok"></span> Valider</button></td></tr>

            </table>
        </form>

        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <div class="modal" id="infos">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h4 class="modal-title">Inscription</h4>
                    </div>
                    <div class="modal-body">
                        <form class="well" method="post" action="traitement/insertMember.php" enctype="multipart/form-data">
                            <table class="table">
                                <tr><td>Pseudo<input type="text" class="form-control" name="pseudo" required></td></tr>
                                <tr><td>Nom<input type="text" class="form-control" name="name" required></td></tr>
                                <tr><td>Email<input type="email" class="form-control" name="mail" required></td></tr>
                                <tr><td>Mot de passe<input type="password" class="form-control" name="password" required></td></tr>
                                <tr><td>Photo <input type="file" name="photo" class="form-control" required></td></tr>
                                <tr><td><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok"></span> Valider</button></td></tr>

                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="infosSite">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">x</button>
                        <h4 class="modal-title">Web-Trotter ??</h4>
                    </div>
                    <div class="modal-body">
                        <p>Vous êtes intéressés par le patrimoine? Web-Trotter est fait pour vous. Nous vous permettons de vous renseigner sur les différents lieux touristiques à
                            voir autour de vous, dans un rayon de distance que vous aurez choisi. Vous pourrez également publier vos articles concernant les sites que vous avez déjà visités!</p>
                        <p>N'hésitez pas à aller lire les articles des autres utilisateurs et leurs laisser vos impressions, cela ne peut que les encourager à continuer, et qui sait, peut-être vous découvrirez-vous des intérêts communs.</p>
                        <p>N'oubliez pas de profiter des moments sur les lieux, et amusez-vous bien en utilisant Web-Trotter.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-lg-4 col-md-4 col-sm-4" <?php if(!($user == 'badLog' )) echo "hidden";?>>
        <div id="ok">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Combinaison identifiant / mot de passe incorrect !</strong></h3>
                            <button class="btn btn-danger"><span class="glyphicon glyphicon-remove"><script>addEventListener('click', function(e) { document.getElementById('ok').style.display = 'none';}, false); </script></span></button> </div>
            </div>
        </div>

    </div>

    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-lg-4 col-md-4 col-sm-4" <?php if(!($user == 'disconnect')) echo "hidden";?>>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Vous avez bien été déconnecté !</strong></h3>
            </div>
        </div>
    </div>
</div>



<?php
    include ('affichage/footer.php');
?>

