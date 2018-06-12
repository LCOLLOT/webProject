<?php
    session_start();
    include "affichage/header.php";
try{
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
}

    $req = $bdd->prepare('SELECT id FROM articles WHERE auteur_id = :id');
    $req->execute(array('id'=>$_SESSION['user_id']));
    ?>

    <h2>Vos contributions</h2>
<div class="row">
<?php
    while($id = $req->fetch()){
        $article = new article($id['id']);
        ?>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <from class="well" method="post" action="traitement/modifArticle.php">
            <table class="table table-bordered">
                <tr>
                    <td><input type="text" name="titre" value="<?php echo $article->getTitre(); ?>"></td>
                </tr>
                <tr>
                    <td><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                             alt="<?php echo $article->getTitre(); ?>" class="img-responsive"></td>
                </tr>
                <tr>
                    <td><input type="text" name="lattitude" value="<?php echo $article->getLattitude(); ?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="longitude" value="<?php echo $article->getLongitude(); ?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="longitude" value="<?php echo $article->getLongitude(); ?>"></td>
                </tr>
            </table>
                </from>
        </div>

        <?php
    }

?>
</div>

<?php
    include "affichage/footer.php";
?>
