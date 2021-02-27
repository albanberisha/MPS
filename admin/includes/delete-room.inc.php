<?php
include('config.php');

$roomid= $_POST['roomid'];

$query = mysqli_query($con, "SELECT * FROM beds, rooms WHERE rooms.id='$roomid' && (beds.roomId=rooms.id && beds.bedstatus=1)");
if (!$query) {
    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
} else {
    if($data=mysqli_fetch_array($query)>0)
    {
       echo $error=1;
    }else{
        $query = mysqli_query($con, "UPDATE rooms SET roomstatus='2' WHERE id='$roomid' ");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
        echo "Success";
        }
    }
}

?>