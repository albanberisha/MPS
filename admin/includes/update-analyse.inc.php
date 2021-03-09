<?php
include('config.php');

$analuyseid=$_POST['id'];
$analuysename=$_POST['name'];
$analuyseprice=$_POST['price'];

$query = mysqli_query($con, "SELECT * From pricing_list WHERE name='$analuysename' and id!=$analuyseid and status=1");
if (!$query) {
    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
} else {
    if($data = mysqli_fetch_array($query)>0)
    {
        echo "error";  
    }else{
        $query = mysqli_query($con, "UPDATE pricing_list SET name='$analuysename', price='$analuyseprice' WHERE id='$analuyseid' ");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
        echo "Success";
        }
    }
    }

?>