<?php
include('config.php');
session_start();
$message="empty";
$userid=$_SESSION['userid'];
$infphoto=$_FILES['file2']['tmp_name'];
if(!empty($infphoto))
{
    $message="notempty";
    $infphoto=file_get_contents($_FILES['file2']['tmp_name']);
    $fileType = $_FILES['file2']['type'];
    if (($fileType != 'image/png' && $fileType != 'image/gif' && $fileType != 'image/jpeg' && $fileType != 'image/jpg') || $_FILES['file2']['size'] > 10485760) {
        echo $error="1";
    }
    else{
        lookotherElements($con, $infphoto,$userid);
    }
}else{
    lookotherElements($con, $infphoto,$userid);
}
//$fileContent = file_get_contents($_FILES['file']['tmp_name']);
function lookotherElements($con,$infphoto,$userid)
{ 
    $name = $_POST['nameInf'];
$surname = $_POST['surnameInf'];
$birthday = $_POST['infstart_date'];
$gender = $_POST['infgender'];
$state = $_POST['stateaddress'];
$city = $_POST['cityaddress'];
$streetaddress = $_POST['streetAddress'];
$phonenumber = $_POST['phone-number'];
$username = $_POST['infusername'];
$departament = $_POST['Infermierdepartament'];

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
}elseif (!preg_match("/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $username) || empty($username)) {
    echo $error="15";
}elseif (checkusernameexistence($con, $username,$userid)) {
    echo $error="16";
}else{
   savedata($con,$userid,$name,$surname,$username,$birthday,$gender,$state,$city,$streetaddress,$phonenumber, $infphoto,$departament);
}
//echo $docposition.$docname.$docsurname.$docbirthday.$gender.$state.$city.$streetaddress.$phonenumber.$docspecialization.$doctordepartament.$adressKDoc.$consultfee.$docemail.$docusername.$docpassword.$docconfirm_password;
}

function    savedata($con,$userid,$name,$surname,$username,$birthday,$gender,$state,$city,$streetaddress,$phonenumber, $infphoto,$departament)
{
    $today = date("Y-m-d h:i:sa");
    $photo = addslashes($infphoto);
    $query = mysqli_query($con, "SELECT * FROM users WHERE id='$userid'");
    $data = mysqli_fetch_array($query);
    $lastupdated = $data['last_updated'];
//if($lastupdated==$today)
if (false) {
    $alert = "Mund te ndryshoni te dhenat vetem nje here brenda dites.";
    echo "<script>
    alert('" . $alert . "');
    window.location.href='manage-doctors.php';
</script>";
} else {
    if(empty($photo))
    {
        $query2 = mysqli_query($con, "UPDATE users SET name='$name' , surname='$surname', username='$username', birthday='$birthday', gender='$gender', state='$state', city='$city', street_address='$streetaddress', phone='$phonenumber', last_updated='$today' WHERE id='$userid'");
    }else{
        $query2 = mysqli_query($con, "UPDATE users SET name='$name' , surname='$surname', username='$username', birthday='$birthday', gender='$gender', state='$state', city='$city', street_address='$streetaddress', phone='$phonenumber', photo='$photo', last_updated='$today' WHERE id='$userid'");
    }
    $query3 = mysqli_query($con, "UPDATE infirmiers SET userId='$userid' , depId='$departament' where userId='$userid'");
}
}

    function checkusernameexistence($con, $username,$id)
    {
        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username' and id!='$id'");
        $data = mysqli_fetch_array($query);
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            if ($data > 0) {
                    return true; //username exists
            } else {
                return false;
            }
        }
    }

?>