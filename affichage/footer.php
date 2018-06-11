    <footer>
    <hr>
        <!-- pied de page -->
        <p>2018. Créé par le groupe Web-Trotter.</p>
        <p>Membres : Lucas CP, Léa B, Samantha L, Florian C, Hamid B, Karl P, Baptiste SA</p>
    </footer>

    <!-- Modale de profil -->
    <?php
        $profil = new Profil($_SESSION['user_id']);
    ?>
    <div class="modal" id="modalProfil">
        <div class="modal-dialog"> <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Mon profil !</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr><td><strong><?php echo $profil->getName();?></strong></td></tr>
                        <tr><td><img src="images/users/<?php echo $profil->getPhoto();?>" alt="<?php echo $profil->getName();?>" class="img-responsive"></td></tr>
                        <tr><td>Date de naissance : <?php echo $profil->getDate();?></td></tr>
                        <tr><td>Pseudo : <?php echo $profil->getPseudo();?></td></tr>
                        <tr><td>Adresse mail : <?php echo $profil->getMail();?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>