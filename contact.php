<?php
include ('affichage/header.php');
?>

    <h2>Nous contacter</h2>
    <div class="row">
        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-5 col-md-5 col-sm-5">
            <table class="table">
                <tr class="warning"><td>Veillez remplir les champs ci-dessous : </td></tr>
                <form class="well" method="post" action="traitement/Contact.php" enctype="multipart/form-data">
                    <tr><td>Nom <input type="text" name="nom" class="form-control" required/></td></tr>
                    <tr><td>Prénom <input type="text" name="prenom" class="form-control"/></td></tr>
                    <tr><td>Adresse mail <input type="email" name="email" class="form-control"/></td></tr>
                    <tr><td>Sujet <input type="text" name="sujet" class="form-control"/></td></tr>
                    <tr><td>Message  <textarea name="message" rows="15" cols="80"></textarea></td></tr>
                    <a class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-pencil"></span> Valider</a>
                </form>
            </table>
        </div>
    </div>

<?php
include ('affichage/footer.php');
?>