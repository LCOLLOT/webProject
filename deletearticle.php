<?php
include ('affichage/headeradmin.php');
include ('log/pdo.php');
?>

<?php
$idToDel = $_GET["idToDelete"];
$bdd->query("DELETE FROM articles WHERE articles.id = $idToDel");
?>

<?php
$idToDel = $_GET["idToDelete"];
echo "L'article $idToDel a bien été supprimé.";
?>

<br>
<br>
<a href="editarticle.php">Retour à la modification des articles</a>


<?php
include ('affichage/footer.php');
?>
