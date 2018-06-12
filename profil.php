<?php
    include ("affichage/header.php");
    $profil = new Profil($_SESSION['user_id']);
?>
<h2>Votre profil</h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
                    <table class="table table-bordered">
                            <tr><td>Nom  :<?php echo $profil->getName();?></td></tr>
                            <tr><td><img src="images/users/<?php echo $profil->getPhoto();?>" alt="<?php echo $profil->getName();?>" class="img-responsive"></td></tr>
                            <tr><td>Date de naissance :<?php echo $profil->getDate();?></td></tr>
                            <tr><td>Pseudonyme :<?php echo $profil->getPseudo();?></td></tr>
                            <tr><td>Adresse mail :<?php echo $profil->getMail();?></td></tr>
                    </table>
    </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <table class="table table-bordered">
                <tr><td>Nom  <?php echo $profil->getName();?></td></tr>
                <tr><td><img src="images/users/<?php echo $profil->getPhoto();?>" alt="<?php echo $profil->getName();?>" class="img-responsive"></td></tr>
                <tr><td>Date de naissance :<?php echo $profil->getDate();?></td></tr>
                <tr><td>Pseudonyme :<?php echo $profil->getPseudo();?></td></tr>
                <tr><td>Adresse mail :<?php echo $profil->getMail();?></td></tr>
            </table>
        </div>
</div>
<?php
include ("affichage/footer.php");
?>