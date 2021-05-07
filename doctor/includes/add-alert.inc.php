<?php
include('config.php');
session_start();

$userInCharge=$_SESSION['id'];
$patientId=$_POST['patientid'];
$today=date(" Y-m-d");//
$alert= $_POST['new-alert'];
$status="1";
if(empty($alert))
{
    echo $error="110";
}else{
    $alertclean=clean($alert);
   if(strcmp($alertclean,$alert)==0)
   {
       if(alertIsActive($con,$alertclean,$patientId))
       {
        echo $error="112";
       }else{
        saveAlert($con,$patientId,$userInCharge,$alertclean,$today,$status);
       }
   }else{
    echo $error="111";
   }
}
function alertIsActive($con,$alertclean,$patientId)
{
    $query=mysqli_query($con,"SELECT id FROM alerts WHERE patientId='$patientId' and description='$alertclean' and status='1'");
    if(!$query)
    {
        die(mysqli_error($con).$query);
    }else{
        $data=mysqli_fetch_array($query);
        if($data>0)
        {
            return true;
        }else{
            return false;
        }
    }
}
function saveAlert($con,$patientId,$userInCharge,$alertclean,$today,$status)
{
    $query = mysqli_query($con,"INSERT INTO alerts(patientId,alertDate,userInCharge,description,status) VALUES ('$patientId','$today','$userInCharge','$alertclean','$status')");
    if(!$query)
    {
        die(mysqli_error($con).$query);
    }else{
        echo "Diagnoza u ruajt me sukses.";
    }
}
function clean($string) {
    $string = str_replace(' ', '--', $string); // Replaces all spaces with hyphens.

    $string =preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    return str_replace('--', ' ', $string); // Removes special chars.
 }
?>