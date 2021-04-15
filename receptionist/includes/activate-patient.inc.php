<?php
include('config.php');
session_start();
$today=date(" Y-m-d H:i:sa ");//
$condition = null;//
$bedid = $_POST['PatientRoom'];//
$patientId= $_POST['patientid'];
$reason= $_POST['description'];
if(!isset( $_POST['cond']))
{
    echo $error="24";
}else{
    $condition = $_POST['cond'];
    if(!isset($_POST['PatientRoom']))
    {
        echo "25";
    }elseif (isNotBedAvailable($con, $bedid, $patientId)) {
        echo "26";
    }else{
        savedata($con,$today,$bedid,$condition,$patientId,$reason);
    }
}

function savedata($con,$today,$bedid,$condition,$patientId,$reason)
{
    $userInCharge=$_SESSION['id'];
    $query5=mysqli_query($con,"UPDATE beds SET patientId='$patientId', beds.condition='$condition' WHERE id='$bedid'");
    $query3 = mysqli_query($con,"INSERT INTO receipts(patientId,entryDateTime,reason,userInCharge,bedId,cond) 
                VALUES('$patientId','$today','$reason','$userInCharge','$bedid','$condition')");
                if (!$query3) {
                    die(mysqli_error($con).$query3);
                     }else{
                        $extra = "../edit-patient.php"; //
                        $host = $_SERVER['HTTP_HOST'];
                        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                        echo "http://".$host.$uri."/".$extra."?id=".$patientId."&edit=patient";
                     }
}
function isNotBedAvailable($con, $bedid, $patientmainID)
{
    $query = mysqli_query($con, "SELECT * from beds where id='$bedid' and patientId='$patientmainID'");
    if (!$query) {
        die(mysqli_error($con) . $query);
    } else {
        $data = mysqli_fetch_array($query);
        if ($data > 0) {
            return false;
        } else {
            $query2 = mysqli_query($con, "SELECT id from beds WHERE beds.bedstatus=1 and beds.id='$bedid' and beds.patientId IS NULL");
            if (!$query2) {
                die(mysqli_error($con) . $query2);
            } else {
                $data2 = mysqli_fetch_array($query2);
                if ($data2 > 0) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }
}
?>