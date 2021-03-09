<?php
include('config.php');
$message="empty";
$staffphoto=$_FILES['file2']['tmp_name'];
if(!empty($staffphoto))
{
    $message="notempty";
    $staffphoto=file_get_contents($_FILES['file2']['tmp_name']);
    $fileType = $_FILES['file2']['type'];
    if (($fileType != 'image/png' && $fileType != 'image/gif' && $fileType != 'image/jpeg' && $fileType != 'image/jpg') || $_FILES['file2']['size'] > 10485760) {
        echo $error="1";
    }
    else{
        lookotherElements($con, $staffphoto);
    }
}else{
    lookotherElements($con, $staffphoto);
}
//$fileContent = file_get_contents($_FILES['file']['tmp_name']);
function lookotherElements($con,$staffphoto)
{
$name = $_POST['nameStaf'];
$surname = $_POST['surnameStaf'];
$birthday = $_POST['stafstart_date'];
$gender = $_POST['stafgender'];
$state = $_POST['stateaddress'];
$city = $_POST['cityaddress'];
$streetaddress = $_POST['streetAddress'];
$phonenumber = $_POST['phone-number'];
$position = $_POST['Stafposition'];
$email = $_POST['staffemail'];
$status="1";

if (empty($name) || (!preg_match("/^([a-zA-Z' ]+)$/", $name))) 
{
    echo $error="2";
}elseif(empty($surname) || (!preg_match("/^([a-zA-Z' ]+)$/", $surname)))
{
    echo $error="3";
}elseif(empty($birthday))
{
    echo $error="4";
}elseif(empty($gender))
{
    echo $error="5";
}elseif (empty($state)) {
    echo $error="6";
} elseif (empty($city)) {
    echo $error="7";
} elseif (empty($streetaddress)) {
    echo $error="8";
} elseif (empty($phonenumber)) {
    echo $error="9";
}elseif(empty($position))
{
    echo $error="11";
}elseif(!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email) || empty($email))
{
    echo $error="13";
}else{
    savedata($con,$name,$surname,$email,$birthday,$gender,$state,$city,$streetaddress,$phonenumber, $staffphoto,$status,$position);
}
//echo $infposition.$docname.$docsurname.$docbirthday.$gender.$state.$city.$streetaddress.$phonenumber.$docspecialization.$doctordepartament.$adressKDoc.$consultfee.$docemail.$docusername.$docpassword.$docconfirm_password;
}

function   savedata($con,$name,$surname,$email,$birthday,$gender,$state,$city,$streetaddress,$phonenumber, $staffphoto,$status,$position)
{
    $today = date("Y-m-d h:i:sa");
    $photo = addslashes($staffphoto);
    $query = mysqli_query($con,"INSERT INTO additional_staff(name,surname,birthday,gender,state,city,street_address,phone,position, email,photo,status,registered,last_updated) VALUES ('$name','$surname','$birthday','$gender','$state','$city','$streetaddress','$phonenumber','$position','$email','$photo','$status','$today','$today')");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query));
    } else {
        $extra = "../add-staf.php"; //
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        echo "http://".$host.$uri."/".$extra."?add=success";
    }
}
?>