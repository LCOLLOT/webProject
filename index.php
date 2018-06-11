<?php
    require 'log/loginManager.php';
    include ('affichage/header.php');

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

}

    if(isset($user) && $user != "badLog" && $user != "disconnect"){
        $_SESSION['user'] = $user;
        $_SESSION['user_id'] = $user_id;
        header("Location: acceuil.php");
        exit();
    }

?>

<div class="row">
    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-lg-4 col-md-4 col-sm-4" id="formLog">
        <form class="well" action="index.php" method="post">
            <table align="center">
                <tr><td><span class="label label-default">Identifiant</span><input type="text" class="form-control" name="login" title="Saisie d'un identifiant"></td></tr>
                <tr><td><span class="label label-default">Mot de passe</span><input type="password" class="form-control" name="password" title="Saisie du mot de passe"></td></tr>
                <tr><td align="center"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span>Valider</button></td></tr>
            </table>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-lg-4 col-md-4 col-sm-4" <?php if(!($user == 'badLog')) echo "hidden";?>>
        <div id="ok">
            <div class="panel panel-danger">
                <div class="panel-heading" align="center">
                    <h3 class="panel-title"><strong>Combinaison identifiant / mot de passe incorrect !</strong>
                            <button class="btn btn-danger"><span class="glyphicon glyphicon-remove"><script>addEventListener('click', function(e) { document.getElementById('ok').style.display = 'none';}, false); </script></span></button> </strong></h3> </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-lg-4 col-md-4 col-sm-4" <?php if(!($user == 'disconnect')) echo "hidden";?>>
        <div>
            <div class="panel panel-warning">
                <div class="panel-heading" align="center">
                    <h3 class="panel-title"><strong>Vous avez bien été déconnecté !</strong>
            </div>
        </div>

    </div>
</div>
</div>

<div>
<div class="row">
    <section class="col-sm-6">
        <p>Vous qui êtes intéressés par le patrimoine, Web-Trotter est fait pour vous.</p>
        <p>Nous vous permettons de vous renseigner sur les différents lieux touristiques à voir autour de vous, dans un rayon de distance que vous aurez choisi.</p>
        <p>Vous pourrez également publier vos articles concernant les sites que vous aurez visité.</p>
        <p>N'hésitez pas à aller lire les articles des autres utilisateurs et leurs laisser vos impressions, cela ne peut que les encourager à continuer, et qui sait, peut-être vous découvrirez-vous des intérêts communs.</p>
        <p>N'oubliez pas de profiter des moments sur les lieux, et amusez-vous bien en utilisant Web-Trotter.</p>
    </section>
    <section class="col-sm-6">
        <img src="images/web-trotter.png" alt="Monument">
    </section>
</div>
</div>

<?php
    include ('affichage/footer.php');
?>

