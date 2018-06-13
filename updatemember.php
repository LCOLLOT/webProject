<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=web-trotter', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$groupe = htmlspecialchars($_POST['NewGroup']);
$id = $_POST['id'];

if(isset($_POST['Update']))
{
    $req = $bdd->prepare('UPDATE users SET groupe = :groupe WHERE users.id = :id');
    $req->execute(array('groupe' => $groupe, 'id'=>$id));
}
else if(isset($_POST['Delete']))
{
    $req = $bdd->prepare('DELETE FROM users WHERE users.id = :id');
    $req->execute(array('id'=>$id));
}

header("Location: admin.php");
exit();

?>

<br>
<br>
<a href="admin.php">Retour à la liste</a>


<?php
include ('affichage/footer.php');
?>