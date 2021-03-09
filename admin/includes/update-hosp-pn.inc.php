<?php
include('config.php');

$id = $_POST['id'];
$price = $_POST['price'];

$query = mysqli_query($con, "UPDATE pricing_list SET price='$price' WHERE id='$id' ");
if (!$query) {
    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
} else {
    echo "Success";
}
?>