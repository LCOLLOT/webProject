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
    if (isset($_POST["Update"]))
    {
        $req = $bdd->prepare("UPDATE articles SET titre=:titre, lattitude=:latitude, longitude=:longitude, description=:description WHERE articles.id = :id");
        $req->execute(array("id" => $id, "titre" => $_POST["titre"], "latitude" => $_POST["latitude"], "longitude" => $_POST["longitude"], "description" => $_POST["description"]));

        echo "L'article a bien été modifié.";
    }

    if (isset($_POST["UpdateSignal"]))
    {
        $req = $bdd->prepare("UPDATE articles SET titre=:titre, lattitude=:latitude, longitude=:longitude, description=:description WHERE articles.id = :id");
        $req->execute(array("id" => $id, "titre" => $_POST["titre"], "latitude" => $_POST["latitude"], "longitude" => $_POST["longitude"], "description" => $_POST["description"]));


        $req2 = $bdd->prepare("DELETE FROM signalement WHERE signalement.article_id = :id");
        $req2->execute(array('id' => $id));

        echo "L'article a bien été modifié et n'est plus considéré comme signalé.";
    }

    else if (isset($_POST["DeleteSignal"]))
    {
        $req2 = $bdd->prepare("DELETE FROM signalement WHERE signalement.article_id = :id");
        $req2->execute(array('id' => $id));

        $req = $bdd->prepare("DELETE FROM articles WHERE articles.id = :id");
        $req->execute(array('id'=> $id));

        echo "L'article a bien été supprimé.";
    }
?>

<br>
<br>
<a href="editarticle.php">Retour à la modération d'articles</a>

<?php
include ('affichage/footer.php');
?>
