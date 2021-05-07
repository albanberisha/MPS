<?php
include('config.php');
session_start();

$regdatetime=$_POST['reg_date'];//
$name = $_POST['namePatient'];//
$surname = $_POST['surnamePatient'];//
$patientid = $_POST['idPatient'];//
$birthday = $_POST['patientstart_date'];//
$gender = $_POST['patgender'];//
$state = $_POST['stateaddress'];//
$city = $_POST['cityaddress'];//
$street = $_POST['streetAddress'];//
$phone = $_POST['phone-number'];//
$deathdate = $_POST['patientdeathate'];//
$deathtime = $_POST['deathTimedate'];//
$receiptdate = $_POST['receiptDate'];//
$docraporting = $_POST['DoctorRaporting'];//
$deathevents = $_POST['deathEvents'];//
$deathcause= $_POST['deathcause'];//
$status=1;//

if(empty($deathdate))
{
    echo $error="10";
}elseif(empty($deathtime))
{
    echo $error="11";
}elseif(empty($receiptdate))
{
    echo $error="12";
}elseif(empty($docraporting))
{
    echo $error="13";
}elseif(empty($deathevents))
{
    echo $error="14";
}else{
    savedata($con,$patientid,$deathdate,$deathtime,$receiptdate,$docraporting,$deathevents, $deathcause);
}

function savedata($con,$patientid,$deathdate,$deathtime,$receiptdate,$docraporting,$deathevents, $deathcause)
{
    $patid=$_SESSION['userid'];
    $query = mysqli_query($con,"INSERT INTO deaths(patientId,deathDay,deathTime,dateOfReceipt,raportedBy,eventsBeforeDeath,deathCause) 
    VALUES('$patid','$deathdate','$deathtime','$receiptdate','$docraporting','$deathevents','$deathcause')");
if (!$query) {
    die(mysqli_error($con).$query);
} else {
    $query2=mysqli_query($con,"UPDATE patients SET status='2' WHERE id='$patid'");
    if (!$query2) {
        die(mysqli_error($con).$query2);
        } else {
            $extra = "../payment.php"; //
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            echo "http://".$host.$uri."/".$extra."?id=$patid&payment=patient";
       
        
    }
}

}
?>
