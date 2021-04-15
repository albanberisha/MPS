<?php
include('config.php');
session_start();
$patientmainID = $_SESSION['patientid'];
$patientstatus = $_POST['patientstatuss']; //
$name = $_POST['namePatient']; //
$surname = $_POST['surnamePatient']; //
$patientid = $_POST['idPatient']; //
$birthday = $_POST['patientstart_date']; //
$gender = $_POST['patgender']; //
$state = $_POST['stateaddress']; //
$city = $_POST['cityaddress']; //
$street = $_POST['streetAddress']; //
$phone = $_POST['phone-number']; //
$email = $_POST['patemail']; //
if ($patientstatus == 1) {
    $condition = $_POST['cond']; //
    $bedid = $_POST['PatientRoom']; //
}else{
    $condition=NULL;
    $bedid=NULL;
}
$PatientBloodtype = $_POST['PatientBloodtype']; //
$name2 = $_POST['name2']; //
$surname2 = $_POST['surname2']; //
$c2 = $_POST['c2']; //
$state2 = $_POST['stateaddress2']; //
$city2 = $_POST['cityaddress2']; //
$street2 = $_POST['streetAddress2']; //
$phone2 = $_POST['phone-number2']; //
if (empty($name) || (!preg_match("/^([a-zA-Z' ]+)$/", $name))) {
    echo $error = "1";
} elseif (empty($surname) || (!preg_match("/^([a-zA-Z' ]+)$/", $surname))) {
    echo $error = "2";
} elseif (empty($birthday)) {
    echo $error = "3";
} elseif (empty($gender)) {
    echo $error = "4";
} elseif (empty($state)) {
    echo $error = "5";
} elseif (empty($city)) {
    echo $error = "6";
} elseif (empty($street)) {
    echo $error = "7";
} elseif (empty($phone)) {
    echo $error = "8";
} elseif (!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email) && !empty($email)) {
    echo $error = "9";
} elseif ($patientstatus == 1) {
    if (isNotBedAvailable($con, $bedid, $patientmainID)) {
        echo "10" . $patientmainID;
    }elseif (!empty($name2) && (!preg_match("/^([a-zA-Z' ]+)$/", $name2))) 
    {
        echo $error="11";
    }elseif (!empty($surname2) && (!preg_match("/^([a-zA-Z' ]+)$/", $surname2))) 
    {
        echo $error="12";
    }elseif (!empty($c2) && (!preg_match("/^([a-zA-Z' ]+)$/", $c2))) 
    {
        echo $error="13";
    }else{
        savedata($con,$patientmainID,$patientstatus,$name,$surname,$patientid,$birthday,$gender,$phone,$state,$city,$street,$email,$PatientBloodtype,$name2,$surname2,$c2,$state2,$city2,$street2,$phone2,$bedid,$condition);
    
    }
}elseif (!empty($name2) && (!preg_match("/^([a-zA-Z' ]+)$/", $name2))) 
{
    echo $error="11";
}elseif (!empty($surname2) && (!preg_match("/^([a-zA-Z' ]+)$/", $surname2))) 
{
    echo $error="12";
}elseif (!empty($c2) && (!preg_match("/^([a-zA-Z' ]+)$/", $c2))) 
{
    echo $error="13";
}else{
    savedata($con,$patientmainID,$patientstatus,$name,$surname,$patientid,$birthday,$gender,$phone,$state,$city,$street,$email,$PatientBloodtype,$name2,$surname2,$c2,$state2,$city2,$street2,$phone2,$bedid,$condition);

}


function savedata($con,$patientmainID,$patientstatus,$name,$surname,$patientid,$birthday,$gender,$phone,$state,$city,$street,$email,$PatientBloodtype,$name2,$surname2,$c2,$state2,$city2,$street2,$phone2,$bedid,$condition)
{
    $alert = "Te dhenat u ruajten me sukses.";
    $query=mysqli_query($con,"UPDATE patients SET name='$name',surname='$surname', patientID='$patientid',birthday='$birthday',phone='$phone',state='$state',city='$city',street_address='$street',email='$email',gender='$gender',blood_type='$PatientBloodtype' WHERE id='$patientmainID'");
    $query2=mysqli_query($con,"UPDATE emergencycontacts SET name='$name2',surname='$surname2',relation='$c2',phone='$phone2',state='$state2',city='$city2',street_address='$street2' WHERE patientId='$patientmainID'");

    if($bedid!=NULL)
    {
        $query3=mysqli_query($con,"UPDATE beds SET patientId=NULL, beds.condition=NULL WHERE patientId='$patientmainID'");
        $query4=mysqli_query($con,"UPDATE beds SET patientId='$patientmainID', beds.condition='$condition' WHERE id='$bedid'");
    }
    unset($_SESSION['patientid']);
    $extra = "../dashboard.php"; //
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    echo "http://".$host.$uri."/".$extra."?add=success";
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