<?php
    include ('affichage/header.php');
?>

<div class="row">
    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-lg-4 col-md-4 col-sm-4" id="formLog">
        <form class="well" action="index.php" method="post">
            <table align="center">
                <tr><td><span class="label label-default">Identifiant</span><input type="text" class="form-control" name="login"></td></tr>
                <tr><td><span class="label label-default">Mot de passe</span><input type="password" class="form-control" name="password"></td></tr>
                <tr><td align="center"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span>Valider</button></td></tr>
            </table>
        </form>
    </div>
</div>

<?php
    include ('affichage/footer.php');
?>

