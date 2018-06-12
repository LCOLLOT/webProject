<?php
include ('affichage/headeradmin.php');
include ('log/pdo.php');
?>

<?php
$idToDel = $_GET["idToDelete"];
$bdd->query("DELETE FROM users WHERE users.id = $idToDel");
?>

<?php
$idToDel = $_GET["idToDelete"];
echo "L'utilisateur $idToDel a bien été supprimé.";
?>

<br>
<br>
<a href="admin.php">Retour à la liste</a>


<?php
include ('affichage/footer.php');
?>
