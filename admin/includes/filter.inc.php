<?php
include('config.php');

$filter = $_POST['filter'];
$querybeds = mysqli_query($con, "SELECT beds.id as bedid, rooms.id as roomid, departaments.depname as depname
from beds JOIN rooms JOIN departaments 
where beds.bedstatus=rooms.roomstatus=departaments.depstatus=1 &&(beds.roomId=rooms.id && rooms.depId=departaments.id) ORDER BY beds.id ASC");
$queryrooms = mysqli_query($con, "SELECT rooms.id as roomid, count(beds.id) as numofbeds, departaments.depname as depname from beds JOIN rooms JOIN departaments WHERE beds.bedstatus=rooms.roomstatus=departaments.depstatus=1 && (beds.roomId=rooms.id && rooms.depId=departaments.id) GROUP BY rooms.id UNION (SELECT DISTINCT rooms.id, 0, departaments.depname from rooms, departaments WHERE (rooms.roomstatus=1 && rooms.depId=departaments.id ) && rooms.id NOT IN (SELECT DISTINCT beds.roomId from beds)) ORDER BY roomid ASC");
if (strcmp($filter, "all") == 0) {
} else {
    $querybeds = mysqli_query($con, "SELECT beds.id as bedid, rooms.id as roomid, departaments.depname as depname from beds JOIN rooms JOIN departaments where (beds.bedstatus=rooms.roomstatus=departaments.depstatus=1 &&(beds.roomId=rooms.id && rooms.depId=departaments.id)) && departaments.id='$filter'  ORDER BY beds.id ASC");
    $queryrooms = mysqli_query($con, "SELECT rooms.id as roomid, count(beds.id) as numofbeds, departaments.depname as depname from beds JOIN rooms JOIN departaments WHERE beds.bedstatus=rooms.roomstatus=departaments.depstatus=1 && (beds.roomId=rooms.id && rooms.depId=departaments.id && departaments.id='$filter') GROUP BY rooms.id UNION (SELECT DISTINCT rooms.id, 0, departaments.depname from rooms, departaments WHERE (rooms.roomstatus=1 && rooms.depId=departaments.id && departaments.id='$filter' ) && rooms.id NOT IN (SELECT DISTINCT beds.roomId from beds)) ORDER BY roomid ASC");
}
?>
<div class="col-md-6 mb-3">
<p id="ResponseBedDelete" style="color:red;"></p>
    <div class="panel-body no-padding">
        <div class="panel-heading">
            <h5 class="panel-title panel-white text-center">Shtreterit</h5>
        </div>
        <table class="data-list min-height">
            <tr class="table-head ">
                <td class="bidh">Numri i shtratit</td>
                <td class="ridh">Numri i dhomes</td>
                <td class="deph">Departamenti</td>
                <td class="actionsh">
            </tr>
        </table>
        <table class="data-list" id="Beds">
            <?php
            if (!$querybeds) {
                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
            } else {
                $cnt = 1;
                while (($data = mysqli_fetch_array($querybeds))) {
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
            }
            ?>
        </table>
    </div>
</div>
<div class="col-md-6">
<p id="ResponseRoomDelete" style="color:red;"></p>
    <div class="panel-body no-padding">
        <div class="panel-heading">
            <h5 class="panel-title panel-white text-center">Dhomat</h5>
        </div>
        <table class="data-list min-height">
            <tr class="table-head ">
                <td class="bidh">Numri i dhomes</td>
                <td class="ridh">Numri i shtreterve</td>
                <td class="deph">Departamenti</td>
                <td class="actionsh">
            </tr>
        </table>
        <table class="data-list" id="Rooms">
            <?php

            if (!$queryrooms) {
                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
            } else {
                while (($data = mysqli_fetch_array($queryrooms))) {
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
            }
            ?>
        </table>
    </div>
</div>
<?php
?>