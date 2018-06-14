<?php
    include ('affichage/headeradmin.php');
    include ('log/pdo.php');

    $userId = $_SESSION["user_id"];
    $profil = new Profil($userId);

    if ($profil->getGroupe() != "admin" && $profil->getGroupe() != "moderateur" )
    {
        http_response_code(403);
        echo "Page interdite w4nn4-83-h4x0r";
        exit();
    }

    if(isset($_POST['recherche']) && !empty($_POST['recherche']))
    {

        //Création des articles correspondant à la recherche
        $recherche = htmlspecialchars($_POST['recherche']);
        //$req = $bdd->prepare('SELECT id FROM articles WHERE titre LIKE :recherche');
        //$req->execute(array('recherche'=> '%'.$recherche.'%'));
    }
  ?>

        <form method="post" action="editarticle.php">
            <table class="table">
                <tr class="tabLigne">
                    <td>Lieu</td>
                </tr>
                <tr>
                    <td><input type="text" name="recherche" class="form-control"
                               placeholder="Tapez une indication du lieu ici"/></td>
                </tr>
                <tr>
                    <td align="center">
                        <button class="btn btn-primary" type="submit"><span
                                    class="glyphicon glyphicon-search"></span>
                        </button>
                    </td>
                </tr>
            </table>
        </form>


<?php
    if(isset($_POST['recherche']) && !empty($_POST['recherche']))
    {

        $recherche = htmlspecialchars($_POST['recherche']);
        $req = $bdd->prepare('SELECT id FROM articles WHERE titre LIKE :recherche ORDER BY id DESC');

        $req->execute(array('recherche'=> '%'.$recherche.'%'));

        while ($data = $req->fetch())
        {
            $article = new article($data['id']);

            ?>
            <form method="post" action="updateArticle.php">
                <input type="hidden" name="id" value="<?php echo $article->getId();?>">
                <div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th class="col-md-5">Titre</th>
                            <th class="col-md-2">Latitude</th>
                            <th class="col-md-2">Longitude</th>
                        </tr>
                        <tr>
                            <td><?php echo $article->getId(); ?></td>
                            <td><input style="width: 100%" type="text" name="titre" value="<?php echo $article->getTitre(); ?>"/></td>
                            <td><input style="width: 100%" type="text" name="latitude" value="<?php echo $article->getLattitude(); ?>"/></td>
                            <td><input style="width: 100%" type="text" name="longitude" value="<?php echo $article->getLongitude(); ?>"/></td>
                        </tr>
                    </table>
                    Description
                    <textarea style="resize: vertical;" name="description" rows="4" cols="70" class="form-control"><?php echo $article->getContenu(); ?></textarea>
                    <div style="float: right;">
                         <button class="btn btn-primary" name="Update"><span class="glyphicon glyphicon-ok"></span></button>
                         <button class="btn btn-danger" name="Delete" onclick="return confirm('Supprimer l\'article <?php echo $article->getTitre(); ?> ?')"><span class="glyphicon glyphicon-remove"></span></button>
                    </div>
                    <br>
                    <br>
                </div>
            </form>
            <br>
            <?php
        }
        $req->closeCursor();
    }
?>

<?php
include ('affichage/footer.php');
?>