

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
<div class="row"> <?php if(!$user == 'badLog') echo "hidden";?>>
        <div id="ok">
            <div class="panel panel-danger">
                <div class="panel-heading" align="center">
                    <h3 class="panel-title"><strong>Combinaison identifiant / mot de passe incorrect !
                            <button class="btn btn-danger"><span class="glyphicon glyphicon-remove"><script>addEventListener('click', function(e) { document.getElementById('ok').style.display = 'none';}, false); </script></span></button> </strong></h3> </div>
            </div>
        </div>

    </div>
</div>

<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<div class="container">
    <button data-toggle="modal" href="#infos" class="btn btn-primary">S'inscrire</button>
    <div class="modal" id="infos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Plus d'informations</h4>
                </div>
                <div class="modal-body">
                    <form class="well" action="index.php" method="post">
                        <table align="center">
                            <tr><td><span class="label label-default">Identifiant</span><input type="text" class="form-control" name="login"></td></tr>
                            <tr><td><span class="label label-default">Mot de passe</span><input type="password" class="form-control" name="password"></td></tr>
                            <tr><td><span class="label label-default">Email</span><input type="email" class="form-control" name="mail"></td></tr>
                            <tr><td align="center"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span>Valider</button></td></tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include ('affichage/footer.php');
?>

