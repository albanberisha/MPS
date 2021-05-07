<?php
include('config.php');
session_start();

$userInCharge=$_SESSION['id'];
$patientId=$_POST['patientid'];
$today=date(" Y-m-d");//
$diagnose= $_POST['new-diagnose'];
$status="1";
if(empty($diagnose))
{
    echo $error="110";
}else{
    $diagnoseclean=clean($diagnose);
   if(strcmp($diagnoseclean,$diagnose)==0)
   {
       if(diagnoseIsActive($con,$diagnoseclean,$patientId))
       {
        echo $error="112";
       }else{
        saveDiagnose($con,$patientId,$userInCharge,$diagnoseclean,$today,$status);
       }
   }else{
    echo $error="111";
   }
}
function diagnoseIsActive($con,$diagnose,$patientId)
{
    $query=mysqli_query($con,"SELECT id FROM diagnosis WHERE patientId='$patientId' and description='$diagnose' and status='1' and enddiagnoseDate IS NULL");
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
function saveDiagnose($con,$patientId,$userInCharge,$diagnose,$today,$status)
{
    $query = mysqli_query($con,"INSERT INTO diagnosis(patientId,userInCharge,description,diagnosedate,status) VALUES('$patientId','$userInCharge','$diagnose','$today','$status')");
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