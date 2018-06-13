<?php
include ('affichage/header.php');
include ('log/pdo.php');

if (!isset($_POST["id"]))
    {
        http_response_code(400);
        echo "Bad request";
        exit();
    }
    $id = $_POST["id"];

    if (isset($_POST["Delete"]))
    {
        $req = $bdd->prepare("DELETE FROM articles WHERE articles.id = :id");
        $req->execute(array('id'=> $id));

        echo "L'article a bien été supprimé.";
    }
    else if (isset($_POST["Update"]))
    {
        $req = $bdd->prepare("UPDATE articles SET titre=:titre, lattitude=:latitude, longitude=:longitude, description=:description WHERE articles.id = :id");
        $req->execute(array("id" => $id, "titre" => $_POST["titre"], "latitude" => $_POST["latitude"], "longitude" => $_POST["longitude"], "description" => $_POST["description"]));

        echo "L'article a bien été modifié.";
    }

    ?>

<br>
<br>
<a href="editarticle.php">Retour à la modification des articles</a>

<?php
include ('affichage/footer.php');
?>
