<?php
include('config.php');

$roomid = $_POST['roomid'];
$query = mysqli_query($con, "INSERT INTO beds(roomId,bedstatus) VALUES('$roomid',1)");
if (!$query) {
    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
} else {
    $query2 = mysqli_query($con, "SELECT max(id) as id FROM beds WHERE roomId='$roomid' and bedstatus='1'");
    if (!$query2) {
        die(mysqli_error($con) . $query2);
    } else {
        $data2 = mysqli_fetch_array($query2);
        if ($data2 > 0) {
            $bedid2 = $data2['id'];
            $query3 = mysqli_query($con, "INSERT INTO actual_condition(bedId) VALUES('$bedid2')");
            if (!$query3) {
                die(mysqli_error($con) . $query3);
            } else {
                $query = mysqli_query($con, "SELECT beds.id as bedid, rooms.id as roomid, departaments.depname as depname
                from beds JOIN rooms JOIN departaments 
                where beds.bedstatus=rooms.roomstatus=departaments.depstatus=1 &&(beds.roomId=rooms.id && rooms.depId=departaments.id)");
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
                                    <?php echo htmlentities($data['bedid']); ?>
                                </td>
                                <td class="rid">
                                    <?php echo htmlentities($data['roomid']); ?>
                                </td>
                                <td class="dep">
                                    <?php echo htmlentities($data['depname']); ?>
                                </td>
                                <td class=" actions" style="margin-top: -10px;">
                                    <span class="delete-data">
                                        <a href="#" onclick="deletebed(<?php echo $data['bedid'] ?>);">
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
        } else {
            echo $error = "error";
        }
    }
}
?>