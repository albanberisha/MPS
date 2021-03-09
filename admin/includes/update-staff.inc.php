<?php
include('config.php');
session_start();
$message="empty";
$staffid=$_SESSION['userid'];
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
        lookotherElements($con, $staffphoto,$staffid);
    }
}else{
    lookotherElements($con, $staffphoto,$staffid);
}
//$fileContent = file_get_contents($_FILES['file']['tmp_name']);
function lookotherElements($con,$staffphoto,$staffid)
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
$email = $_POST['stafemail'];

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
    savedata($con,$staffid,$name,$surname,$email,$birthday,$gender,$state,$city,$streetaddress,$phonenumber, $staffphoto,$position);
}
//echo $infposition.$docname.$docsurname.$docbirthday.$gender.$state.$city.$streetaddress.$phonenumber.$docspecialization.$doctordepartament.$adressKDoc.$consultfee.$docemail.$docusername.$docpassword.$docconfirm_password;
}

function savedata($con,$staffid,$name,$surname,$email,$birthday,$gender,$state,$city,$streetaddress,$phonenumber, $staffphoto,$position)
{
    $today = date("Y-m-d h:i:sa");
    $photo = addslashes($staffphoto);
    $query = mysqli_query($con, "SELECT * FROM additional_staff WHERE id='$staffid'");
    $data = mysqli_fetch_array($query);
    $lastupdated = $data['last_updated'];
//if($new_datetoday==$new_datetolast){
if (false) {
    $alert = "Mund te ndryshoni te dhenat vetem nje here brenda dites.";
    echo "<script>
    alert('" . $alert . "');
    window.location.href='manage-doctors.php';
</script>";
} else {
    if(empty($photo))
    {
        $query2 = mysqli_query($con, "UPDATE additional_staff SET name='$name' , surname='$surname', birthday='$birthday', gender='$gender', state='$state', city='$city', street_address='$streetaddress', phone='$phonenumber',position='$position',email='$email', last_updated='$today' WHERE id='$staffid'");
    }else{
        $query2 = mysqli_query($con, "UPDATE additional_staff SET name='$name' , surname='$surname', birthday='$birthday', gender='$gender', state='$state', city='$city', street_address='$streetaddress', phone='$phonenumber',position='$position',email='$email',photo='$photo', last_updated='$today' WHERE id='$staffid'");    }
}
}

?>