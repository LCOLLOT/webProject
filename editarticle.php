<?php
    include ('affichage/header.php');
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage()); // on arrête tous les processus et on affiche le message d'erreur
    }

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

<?php
    if(isset($_POST['recherche']) && !empty($_POST['recherche']))
    {
        $recherche = htmlspecialchars($_POST['recherche']);
        $req = $bdd->prepare('SELECT id FROM articles WHERE titre LIKE :recherche ORDER BY id');
        $req->execute(array('recherche'=> '%'.$recherche.'%'));

        while ($data = $req->fetch())
        {
            $article = new article($data['id']);

            ?>
            <form method="post" action="updateArticle.php">
                <input type="hidden" name="id" value="<?php echo $article->getId();?>">
                <table>
                    <tr>
                        <td>ID <?php echo $article->getId(); ?>
                        <td>Titre <input type="text" name="titre" value="<?php echo $article->getTitre(); ?>"/></td>
                        <td>Photo  <input type="file" name="photo" class="form-control"/></td>
                        <td>Latitude <input type="text" name="latitude" value="<?php echo $article->getLattitude(); ?>"/></td>
                        <td>Longitude <input type="text" name="longitude" value="<?php echo $article->getLongitude(); ?>"/></td>
                        <td>Description <textarea name="description" rows="10" cols="50" class="form-control"><?php echo $article->getContenu(); ?></textarea></td>
                        <td>
                            <input type="submit" name="Delete" value="Supprimer"></input>
                            <input type="submit" name="Update" value="Sauvegarder"></input>
                        </td>
                    </tr>
                </table>
            </form>
            <?php
        }
        $req->closeCursor();
    }


?>
</table>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12" id="searchBarre" align="center">

            <div class="col-lg-3 col-md-3 col-sm-3">
                <form method="post" action="editarticle.php">
                    <table align="center">
                        <tbody>
                        <tr><td>Recherche</td></tr>
                        <tr><td><input type="text" name="recherche" class="form-control"/></td></tr>
                        <tr><td align="center"><button class="btn btn-primary acentrer" type="submit"><span class="glyphicon glyphicon-ok-sign"></span>Rechercher</button></td></tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    </table>


<?php
include ('affichage/footer.php');
?>