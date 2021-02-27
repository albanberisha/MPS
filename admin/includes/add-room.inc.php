<?php
include('config.php');

$depid = $_POST['depid'];
$date = date("Y-m-d");
$query = mysqli_query($con, "INSERT INTO rooms(depid,creationdate,roomstatus) VALUES('$depid','$date',1)");
if (!$query) {
    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
} else {
    $query = mysqli_query($con, "SELECT rooms.id as roomid, count(beds.id) as numofbeds, departaments.depname as depname from beds JOIN rooms JOIN departaments WHERE beds.bedstatus=rooms.roomstatus=departaments.depstatus=1 && (beds.roomId=rooms.id && rooms.depId=departaments.id) GROUP BY rooms.id UNION (SELECT DISTINCT rooms.id, 0, departaments.depname from rooms, departaments WHERE (rooms.roomstatus=1 && rooms.depId=departaments.id ) && rooms.id NOT IN (SELECT DISTINCT beds.roomId from beds)) ORDER BY roomid ASC");

    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
    } else {
?>
        <tbody>
            <?php
            while (($data = mysqli_fetch_array($query))) {
            ?>
                <tr>
                    <td class="bid">
                        <?php echo htmlentities($data['roomid']); ?>
                    </td>
                    <td class="rid">
                        <?php echo htmlentities($data['numofbeds']); ?>
                    </td>
                    <td class="dep">
                        <?php echo htmlentities($data['depname']); ?>
                    </td>
                    <td class=" actions" style="margin-top: -10px;">
                        <span class="delete-data">
                            <a href="#" onclick="deleteroom(<?php echo $data['roomid'] ?>);">
                                <img style="margin-top: -15px;" src="img/delete-icon.png">
                            </a>
                        </span>
                    </td>

                </tr>
            <?php
            }
            ?>
        </tbody>
<?php
    }
}
?>