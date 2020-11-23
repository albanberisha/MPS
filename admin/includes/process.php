<?php
include 'dtbconn.php';

$message = $_POST['text-type'];

$sqlQuery = "INSERT INTO messages1(NGA, tek,mesage, data) VALUES(1,2,'$message',1999)";
print_r($sqlQuery);
$result=mysqli_query($conn,$sqlQuery);

?>