<?php
include ('affichage/headeradmin.php');

$users = $bdd->query('SELECT * FROM users ');
?>

    <div class="tg-wrap"><table class="membres">
    <?php
        while ($data = $users->fetch())
    {
        ?>

        <form method="post" action="updatemember.php">
            <input type="hidden" name="id" value="<?php echo $data['id'];?>">
            <table class="table table-striped">
                <colgroup>
                    <col style="width: 3%">
                    <col style="width: 10%">
                    <col style="width: 20%">
                    <col style="width: 1%">
                    <col style="width: 5%">
                    <col style="width: 20%">
                </colgroup>
                <tr>
                    <td><?php echo $data['id'];?></td>
                    <td><?php echo $data['name'];?></td>
                    <td><?php echo $data['mail'];?></td>
                    <td>
                        <select name="NewGroup">
                            <option value="admin" <?php if ($data['groupe'] == "admin") echo "selected"; ?>>Admin</option>
                            <option value="moderateur" <?php if ($data['groupe'] == "moderateur") echo "selected"; ?>>Modérateur</option>
                            <option value="membre" <?php if ($data['groupe'] == "membre") echo "selected"; ?>>Membre</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-primary" name="Update"><span class="glyphicon glyphicon-ok"></span></button>
                        <button class="btn btn-danger" name="Delete" onclick="return confirm('Supprimer définitvement le membre <?php echo $data['name']; ?> ?')"><span class="glyphicon glyphicon-remove"></span></button>
                    </td>
                </tr>
            </table>
        </form>
        <?php
    }
    $users->closeCursor();
    ?>
    </table></div>

<?php
include ('affichage/footer.php');
?>