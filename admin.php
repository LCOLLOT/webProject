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
    <tr>
        <td><?php echo $data['id'];?></td>
        <td><?php echo $data['name'];?></td>
        <td><?php echo $data['mail'];?></td>
        <td><form method=\"post\" action=deletemember.php>
    <button type="submit" name="idToDelete" value="<?php echo $data['id'];?>">Supprimer</button>
            </form>
    </tr>
    <?php
}
$users->closeCursor();

?>
</table>

<?php
include ('affichage/footer.php');
?>