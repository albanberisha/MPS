<?php
include('config.php');
session_start();
$regdatetime=$_POST['reg_date'];//
$reason=$_POST['description'];//
$name = $_POST['namePatient'];//
$surname = $_POST['surnamePatient'];//
$patientid = $_POST['idPatient'];//
$birthday = $_POST['patientstart_date'];//
$gender = $_POST['patgender'];//
$state = $_POST['stateaddress'];//
$city = $_POST['cityaddress'];//
$street = $_POST['streetAddress'];//
$phone = $_POST['phone-number'];//
$email = $_POST['patemail'];//
$bedid = $_POST['PatientRoom'];//
$PatientBloodtype = $_POST['PatientBloodtype'];//
$name2 = $_POST['name2'];//
$surname2 = $_POST['surname2'];//
$c2 = $_POST['c2'];//
$state2 = $_POST['stateaddress2'];//
$city2 = $_POST['cityaddress2'];//
$street2 = $_POST['streetAddress2'];//
$phone2 = $_POST['phone-number2'];//
$status=1;//

if (empty($name) || (!preg_match("/^([a-zA-Z' ]+)$/", $name))) 
{
    echo $error="1";
}elseif(empty($surname) || (!preg_match("/^([a-zA-Z' ]+)$/", $surname)))
{
    echo $error="2";
}elseif(empty($birthday))
{
    echo $error="3";
}elseif(empty($gender))
{
    echo $error="4";
}elseif (empty($state)) {
    echo $error="5";
} elseif (empty($city)) {
    echo $error="6";
} elseif (empty($street)) {
    echo $error="7";
} elseif (empty($phone)) {
    echo $error="8";
}elseif(!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email) && !empty($email))
{
    echo $error="9";
}elseif (!empty($name2) && (!preg_match("/^([a-zA-Z' ]+)$/", $name2))) 
{
    echo $error="10";
}elseif (!empty($surname2) && (!preg_match("/^([a-zA-Z' ]+)$/", $surname2))) 
{
    echo $error="11";
}elseif (!empty($c2) && (!preg_match("/^([a-zA-Z' ]+)$/", $c2))) 
{
    echo $error="12";
}else{
    savedata($con,$name,$surname,$patientid,$birthday,$phone,$state,$city,$street,$email,$gender,$PatientBloodtype,$regdatetime,$status,$name2,$surname2,$c2,$state2,$city2,$street2,$phone2,$bedid,$reason);
}


function savedata($con,$name,$surname,$patientid,$birthday,$phone,$state,$city,$street,$email,$gender,$PatientBloodtype,$regdatetime,$status,$name2,$surname2,$c2,$state2,$city2,$street2,$phone2,$bedid,$reason)
{
    $query = mysqli_query($con,"INSERT INTO patients(name,surname,patientID,birthday,phone,state,city,street_address,email,gender,blood_type,registered,status) VALUES('$name','$surname','$patientid','$birthday','$phone','$state','$city','$street','$email','$gender','$PatientBloodtype','$regdatetime','$status')");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query));
    } else {
        $regdatetime=substr($regdatetime,0,-2);
        $query = mysqli_query($con, "SELECT id FROM patients where name='$name' and registered='$regdatetime' ");
        $data=mysqli_fetch_array($query);
        if($data>0)
        {
            $patientid=$data['id'];
            $userInCharge=$_SESSION['id'];
            $query2 = mysqli_query($con,"INSERT INTO emergencycontacts(patientId,name,surname,relation,phone,state,city,street_address) 
            VALUES('$patientid','$name2','$surname2','$c2','$phone2','$state2','$city2','$street2')");
            if (!$query2) {
                die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query2));
            }else{
                if($bedid==0)
                {
                    $query3 = mysqli_query($con,"INSERT INTO receipts(patientId,entryDateTime,exitDateTime,reason,userInCharge,cond) 
                VALUES('$patientid','$regdatetime','$regdatetime','$reason','$userInCharge','red')");
                if (!$query3) {
                    die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query3));
                     }else{
                        $extra = "../register-patients.php"; //
                        $host = $_SERVER['HTTP_HOST'];
                        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                        echo "http://".$host.$uri."/".$extra."?add=success";
                     }
                }else{
                    $query4 = mysqli_query($con,"INSERT INTO receipts(patientId,entryDateTime,reason,userInCharge,bedId,cond) 
                VALUES('$patientid','$regdatetime','$reason','$userInCharge','$bedid','red')");
                if (!$query4) {
                    die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query4));
                     }else{
                        $extra = "../register-patients.php"; //
                        $host = $_SERVER['HTTP_HOST'];
                        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                        echo "http://".$host.$uri."/".$extra."?add=success";
                     }

                }
                
            
        }}}
    }

?>