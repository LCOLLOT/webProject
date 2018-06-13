<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$groupe = htmlspecialchars($_POST['NewGroup']);
var_dump($_POST['NewGroup']);
$id = $_POST['id'];

echo $groupe;
echo $id;

$req = $bdd->prepare('UPDATE users SET groupe = :groupe WHERE users.id = :id');
$req->execute(array('groupe' => $groupe, 'id'=>$id));

//header("Location: ../acceuil.php");
//exit();

//$idToDel = $_GET["idToDelete"];
//$bdd->query("DELETE FROM users WHERE users.id = $idToDel");
?>

<br>
<br>
<a href="admin.php">Retour à la liste</a>


<?php
include ('affichage/footer.php');
?>