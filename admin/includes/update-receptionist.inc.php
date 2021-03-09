<?php
include('config.php');
session_start();
$message="empty";
$userid=$_SESSION['userid'];
$recphoto=$_FILES['file2']['tmp_name'];
if(!empty($recphoto))
{
    $message="notempty";
    $recphoto=file_get_contents($_FILES['file2']['tmp_name']);
    $fileType = $_FILES['file2']['type'];
    if (($fileType != 'image/png' && $fileType != 'image/gif' && $fileType != 'image/jpeg' && $fileType != 'image/jpg') || $_FILES['file2']['size'] > 10485760) {
        echo $error="1";
    }
    else{
        lookotherElements($con, $recphoto,$userid);
    }
}else{
    lookotherElements($con, $recphoto,$userid);
}
//$fileContent = file_get_contents($_FILES['file']['tmp_name']);
function lookotherElements($con,$recphoto,$userid)
{ 
    $recname = $_POST['nameRec'];
$recsurname = $_POST['surnameRec'];
$recbirthday = $_POST['recstart_date'];
$gender = $_POST['recgender'];
$state = $_POST['stateaddress'];
$city = $_POST['cityaddress'];
$streetaddress = $_POST['streetAddress'];
$phonenumber = $_POST['phone-number'];
$recusername = $_POST['recusername'];

if (empty($recname) || (!preg_match("/^([a-zA-Z' ]+)$/", $recname))) 
{
    echo $error="2";
}elseif(empty($recsurname) || (!preg_match("/^([a-zA-Z' ]+)$/", $recsurname)))
{
    echo $error="3";
}elseif(empty($recbirthday))
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
}elseif (!preg_match("/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $recusername) || empty($recusername)) {
    echo $error="15";
}elseif (checkusernameexistence($con, $recusername,$userid)) {
    echo $error="16";
}else{
   savedata($con,$userid,$recname,$recsurname,$recusername,$recbirthday,$gender,$state,$city,$streetaddress,$phonenumber, $recphoto);
}
//echo $docposition.$docname.$docsurname.$docbirthday.$gender.$state.$city.$streetaddress.$phonenumber.$docspecialization.$doctordepartament.$adressKDoc.$consultfee.$docemail.$docusername.$docpassword.$docconfirm_password;
}

function savedata($con,$userid,$recname,$recsurname,$recusername,$recbirthday,$gender,$state,$city,$streetaddress,$phonenumber, $recphoto)
{
    $today = date("Y-m-d h:i:sa");
    $photo = addslashes($recphoto);
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
        $query2 = mysqli_query($con, "UPDATE users SET name='$recname' , surname='$recsurname', username='$recusername', birthday='$recbirthday', gender='$gender', state='$state', city='$city', street_address='$streetaddress', phone='$phonenumber', last_updated='$today' WHERE id='$userid'");
    }else{
        $query2 = mysqli_query($con, "UPDATE users SET name='$recname' , surname='$recsurname', username='$recusername', birthday='$recbirthday', gender='$gender', state='$state', city='$city', street_address='$streetaddress', phone='$phonenumber', photo='$photo', last_updated='$today' WHERE id='$userid'");
    }
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