<?php
include('config.php');

$bedid= $_POST['bedid'];

$query = mysqli_query($con, "SELECT * from beds WHERE id='$bedid' AND patientId IS NOT NULL");
if (!$query) {
    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
} else {
    if($data=mysqli_fetch_array($query)>0)
    {
       echo $error=1;
    }else{
        $query = mysqli_query($con, "UPDATE beds SET bedstatus='2' WHERE id='$bedid' ");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
        echo "Success";
        }
    }
}

?>