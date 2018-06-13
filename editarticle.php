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
                <table>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Titre</td>
                                    <td>Latitude</td>
                                    <td>Longitude</td>


                                </tr>
                                <tr>
                                    <td><?php echo $article->getId(); ?></td>
                                    <td><input type="text" name="titre" value="<?php echo $article->getTitre(); ?>"/></td>
                                    <td><input type="text" name="latitude" value="<?php echo $article->getLattitude(); ?>"/></td>
                                    <td> <input type="text" name="longitude" value="<?php echo $article->getLongitude(); ?>"/></td>

                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <td>Description</td>
                                </tr>
                                <tr>
                                    <td> <textarea name="description" rows="4" cols="70" class="form-control"><?php echo $article->getContenu(); ?></textarea></td>
                                </tr>
                                <td>
                                    <input type="submit" name="Delete" value="Supprimer"></input>
                                    <input type="submit" name="Update" value="Sauvegarder"></input>
                                </td>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
            <?php
        }
        $req->closeCursor();
    }
?>

<?php
include ('affichage/footer.php');
?>