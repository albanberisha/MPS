<?php
include('config.php');
session_start();
$message="empty";
$userid=$_SESSION['userid'];
$docphoto=$_FILES['file2']['tmp_name'];
if(!empty($docphoto))
{
    $message="notempty";
    $docphoto=file_get_contents($_FILES['file2']['tmp_name']);
    $fileType = $_FILES['file2']['type'];
    if (($fileType != 'image/png' && $fileType != 'image/gif' && $fileType != 'image/jpeg' && $fileType != 'image/jpg') || $_FILES['file2']['size'] > 10485760) {
        echo $error="1";
    }
    else{
        lookotherElements($con, $docphoto,$userid);
    }
}else{
    lookotherElements($con, $docphoto,$userid);
}
//$fileContent = file_get_contents($_FILES['file']['tmp_name']);
function lookotherElements($con,$docphoto,$userid)
{ 
$docname = $_POST['nameDoc'];
$docsurname = $_POST['surnameDoc'];
$docbirthday = $_POST['docstart_date'];
$gender = $_POST['docgender'];
$state = $_POST['stateaddress'];
$city = $_POST['cityaddress'];
$streetaddress = $_POST['streetAddress'];
$phonenumber = $_POST['phone-number'];
$adressKDoc = $_POST['adressKDoc'];
$docspecialization = $_POST['Doctorspecialization'];
$doctordepartament = $_POST['Doctordepartament'];
$consultfee = $_POST['Consultfee'];
$docusername = $_POST['docusername'];

if (empty($docname) || (!preg_match("/^([a-zA-Z' ]+)$/", $docname))) 
{
    echo $error="2";
}elseif(empty($docsurname) || (!preg_match("/^([a-zA-Z' ]+)$/", $docsurname)))
{
    echo $error="3";
}elseif(empty($docbirthday))
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
}elseif($consultfee<0)
{
    echo $error="12";
}elseif (!preg_match("/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $docusername) || empty($docusername)) {
    echo $error="15";
}elseif (checkusernameexistence($con, $docusername,$userid)) {
    echo $error="16";
}else{
   savedata($con,$userid,$docname,$docsurname,$docusername,$docbirthday,$gender,$state,$city,$streetaddress,$phonenumber, $docphoto,$docspecialization,$adressKDoc,$consultfee,$doctordepartament);
}
//echo $docposition.$docname.$docsurname.$docbirthday.$gender.$state.$city.$streetaddress.$phonenumber.$docspecialization.$doctordepartament.$adressKDoc.$consultfee.$docemail.$docusername.$docpassword.$docconfirm_password;
}

function savedata($con,$userid,$docname,$docsurname,$docusername,$docbirthday,$gender,$state,$city,$streetaddress,$phonenumber, $docphoto,$docspecialization,$adressKDoc,$consultfee,$doctordepartament)
{
    $today = date("Y-m-d h:i:sa");
    $photo = addslashes($docphoto);
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
        $query2 = mysqli_query($con, "UPDATE users SET name='$docname' , surname='$docsurname', username='$docusername', birthday='$docbirthday', gender='$gender', state='$state', city='$city', street_address='$streetaddress', phone='$phonenumber', last_updated='$today' WHERE id='$userid'");
    }else{
        $query2 = mysqli_query($con, "UPDATE users SET name='$docname' , surname='$docsurname', username='$docusername', birthday='$docbirthday', gender='$gender', state='$state', city='$city', street_address='$streetaddress', phone='$phonenumber', photo='$photo', last_updated='$today' WHERE id='$userid'");
    }
    $query3 = mysqli_query($con, "UPDATE doctors SET specialties='$docspecialization' , departament='$doctordepartament' where userId='$userid'");
    $query4 = mysqli_query($con, "UPDATE doctors SET consultancy_fees='$consultfee',clinic_address='$adressKDoc' where userId='$userid'");

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