<?php
include('config.php');

$analyseid = $_POST['id'];

$query = mysqli_query($con, "UPDATE pricing_list SET status='2' WHERE id='$analyseid' ");
if (!$query) {
    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
} else {
    $query = mysqli_query($con, "SELECT * From pricing_list WHERE status=1 && description='Analyse'");
            if (!$query) {
                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
            } else {
                while (($data = mysqli_fetch_array($query))) {
            ?>
                    <tr>
                        <td class="dep">
                            <?php echo htmlentities($data['name']); ?>
                        </td>
                        <td class="dep">
                            <?php echo htmlentities($data['price']); ?>
                        </td>
                        <td class=" actions" >
                            <span class="edit-data" onclick="window.open('edit-analyse.php', '_self');">
                            <a href="edit-analyse.php" >
                            <img src="img/edit-icon.png">                                            </a>
                            </span>
                            <span class="delete-data">
                                <a href="#" onclick="deleteanalyse(<?php echo $data['id'] ?>);">
                                    <img src="img/delete-icon.png">
                                </a>
                            </span>
                        </td>
                    </tr>
            <?php
                }
            }
}
?>