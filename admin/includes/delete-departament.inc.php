<?php
include('config.php');

$id = $_POST['id'];
$row = $_POST['row'];
$query = mysqli_query($con, "SELECT * FROM departaments, rooms WHERE departaments.id='$id' && (departaments.id=rooms.depId && rooms.roomstatus=1)");
if (!$query) {
    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
} else {
    if ($data = mysqli_fetch_array($query) > 0) {
        echo $error = 1;
    } else {

        $query = mysqli_query($con, "UPDATE departaments SET depstatus=2 WHERE id='$id' ");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $query = mysqli_query($con, "SELECT * from departaments WHERE depstatus=1");

            if (!$query) {
                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
            } else {
?>
                <tr>
                    <th class="panel-title title3 ">
                        Emri
                    </th>
                    <th class="actionsh">
                    </th>
                </tr>
                <?php
                $query = mysqli_query($con, "SELECT * from departaments WHERE depstatus=1");

                if (!$query) {
                    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                } else {
                    $cnt = 1;
                    while (($data = mysqli_fetch_array($query))) {

                ?>
                        <tr id="<?php echo $cnt; ?>">
                            <td class="title1">
                                <?php echo htmlentities($data['depname']); ?>
                            </td>
                            <td class=" actions" style="margin-top: -10px;">
                                <span class="delete-data">
                                    <a href="#" onclick="deletedep(<?php echo $data['id'] ?>,<?php echo $cnt ?>);">
                                        <img style="margin-top: -15px;" src="img/delete-icon.png">
                                    </a>
                                </span>
                            </td>
                        </tr>
<?php
                        $cnt = $cnt + 1;
                    }
                }
            }
        }
    }
}
?>