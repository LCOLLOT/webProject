<?php
    include ("affichage/header.php");
    $profil = new Profil($_SESSION['user_id']);
?>
<h2>Votre profil</h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
                    <table class="table table-bordered">
                            <tr><td>Nom  :<input type="text" name="nom" value="<?php echo $profil->getName();?>"/></td></tr>
                            <tr><td><img src="images/users/<?php echo $profil->getPhoto();?>" alt="<?php echo $profil->getName();?>" class="img-responsive"></td></tr>
                            <tr><td>Date de naissance :<input type="text" name="dateNaissance" value="<?php echo $profil->getDate();?>" class="form-control"/></td></tr>
                            <tr><td>Pseudonyme :<input type="text" name="pseudo" value="<?php echo $profil->getPseudo();?>" class="form-control"/></td></tr>
                            <tr><td>Adresse mail :<input type="text" name="mail" value="<?php echo $profil->getMail();?>"/></td></tr>
                    </table>
    </div>
</div>
<?php
include ("affichage/footer.php");
?>