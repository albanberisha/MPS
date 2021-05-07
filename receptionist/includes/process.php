
<?php
include('config.php');
$from  = $_POST['from'];
$to =$_POST['to'];
$message = $_POST['message'];
$status=0;
$now=date("Y-m-d h:i:sa");
$sqlQuery = "INSERT INTO messages(message, msgfrom,msgto,status,datetime) VALUES('$message','$from','$to','$status','$now')";
$result=mysqli_query($con,$sqlQuery);
if(!$result)
{
    die(mysqli_error($con).$sqlQuery);
}else{
    echo $message;
}

?>