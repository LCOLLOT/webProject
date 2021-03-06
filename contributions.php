<?php
session_start();
include "affichage/header.php";
include('log/pdo.php');


$req = $bdd->prepare('SELECT id FROM articles WHERE auteur_id = :id');
    $req->execute(array('id'=>$_SESSION['user_id']));
    ?>

    <h2>Vos contributions</h2>
<div class="row">
<?php
    while($id = $req->fetch()){
        $article = new article($id['id']);
        ?>
        <div class="item">
            <table class="table table-bordered">
                <form class="well" method="post" action="traitement/modifArticle.php">
                <tr>
                    <td>Titre <input type="text" name="titre" value="<?php echo $article->getTitre(); ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td align="center"><img src="images/articles/<?php echo $article->getPhoto(); ?>"
                             alt="<?php echo $article->getTitre(); ?>" class="img-responsive" style="max-height: 200px"></td>
                </tr>
                <tr>
                    <td>Lattitude<input type="text" name="lattitude" value="<?php echo $article->getLattitude(); ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Longitude<input type="text" name="longitude" value="<?php echo $article->getLongitude(); ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Description<textarea name="description" class="form-control"><?php echo $article->getContenu()?></textarea></td>
                </tr>
                    <input type="text" name="id_article" value="<?php echo $id['id'];?>">
                <tr><td><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-send"></span> Modifier</button></td></tr>
                </form>

            </table>
        </div>

        <?php
    }

?>
</div>

<?php
    include "affichage/footer.php";
?>
