<?php
include ('affichage/header.php');
?>

    <!-- Comme j'ai un problème de version du projet avec PhpStorm, easyphp et SQL, je fais le bouton
    qui doit être sur la page d'accueil à part -->

    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <button data-toggle="modal" href="#infos" class="btn btnprimary">S'inscrire</button>
    <div class="modal" id="infos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" datadismiss="modal">x</button>
                    <h4 class="modal-title" align="center">Inscription</h4>
                </div>
                <div class="modal-body">
                    <form class="well" action="index.php" method="post">
                        <table align="center">
                            Pseudo<input type="text" class="form-control" name="login" required>
                            Email<input type="email" class="form-control" name="email" required>
                            Mot de passe<input type="password" class="form-control" name="password" required>
                            Confirmez le mot de passe<input type="password" class="form-control" name="password" required>

                            <tr><td><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok-sign"></span>Valider</button></td></tr>
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