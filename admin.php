<?php
include ('affichage/headeradmin.php');

$users = $bdd->query('SELECT * FROM users ');
?>

    <a href="editarticle.php">Modifier des articles</a>
    <br>

<table id="membres">
                <tr>
                    <th>id</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                </tr>
<?php
    while ($data = $users->fetch())
{
    ?>
    <form method="post" action="updatemember.php">
        <input type="hidden" name="id" value="<?php echo $data['id'];?>">
        <table>
        <tr>
            <td><?php echo $data['id'];?></td>
            <td><?php echo $data['name'];?></td>
            <td><?php echo $data['mail'];?></td>
            <td>
                <input type="submit" name="Delete" value="Supprimer">
                <select name="NewGroup">
                    <option value="admin" <?php if ($data['groupe'] == "admin") echo "selected"; ?>>Admin</option>
                    <option value="moderateur" <?php if ($data['groupe'] == "moderateur") echo "selected"; ?>>Modérateur</option>
                    <option value="membre" <?php if ($data['groupe'] == "membre") echo "selected"; ?>>Membre</option>
                </select>

                <input type="submit" name="Update" value="Sauvegarder">
            </td>
        </tr>
        </table>
    </form>

    <?php
}
$users->closeCursor();

?>
</table>

<?php
include ('affichage/footer.php');
?>