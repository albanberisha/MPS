<?php
include('config.php');

$userid = $_POST['id'];
$table = $_POST['table'];


if (strcmp($table, "medicaments") == 0) {
    $medid=$userid;
    deletemedicament($con, $medid);
}else{
    $echo="error";
}

function deletemedicament($con, $medid)
{
    $query = mysqli_query($con, "UPDATE medicaments SET status='2' WHERE id='$medid' ");
    if (!$query) {
        die(mysqli_error($con).$query);
    } else {
        $query = mysqli_query($con, "SELECT * from medicaments where status='1' ORDER BY quantity-lowStock ASC");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $count = 1;
            while (($data = mysqli_fetch_array($query))) {
                $today = date("Y-m-d");
                if ($data['expired_date'] <= $today) {
        ?>
                    <tr style="background-color: red; color:white;">
                    <?php
                } elseif($data['lowStock']>=$data['quantity']) {
                    ?>
                    <tr style="color:red;">
                    <?php
                }else{
                    ?>
                    <tr>
                    <?php
                }
                    ?>
                        <td class="mid">
                            <?php
                            echo $count; ?>
                        </td>
                    <?php
                    ?>
                    <td class="medname">
                        <?php echo htmlentities($data['name']); ?>
                    </td>
                    <td class="expdate">
                        <?php
                        $today = date("Y-m-d");
                        echo htmlentities($data['expired_date']); ?>
                    </td>
                    <td class="desc">
                    <?php echo htmlentities($data['quantity']); ?> [<?php echo htmlentities($data['lowStock']); ?>]
                    </td>
                    <td class=" actions">
                        <span class="edit-data">
                            <a href="edit-medicament.php?id=<?php echo $data['id'] ?>&edit=medicament">
                                <img src="img/edit-icon.png"> </a>
                        </span>
                        <span class="delete-data">
                            <a href="#" onclick="deletemedicament(<?php echo $data['id'] ?>);">
                                <img src="img/delete-icon.png">
                            </a>
                        </span>
                    </td>
                    </tr>
            <?php
                $count++;
            }
        }
    }
}
        ?>