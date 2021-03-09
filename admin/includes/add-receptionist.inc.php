<?php
include('config.php');
$message="empty";
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
        lookotherElements($con, $recphoto);
    }
}else{
    lookotherElements($con, $recphoto);
}
//$fileContent = file_get_contents($_FILES['file']['tmp_name']);
function lookotherElements($con,$recphoto)
{
$recname = $_POST['nameRec'];
$recsurname = $_POST['surnameRec'];
$recbirthday = $_POST['recstart_date'];
$gender = $_POST['recgender'];
$state = $_POST['stateaddress'];
$city = $_POST['cityaddress'];
$streetaddress = $_POST['streetAddress'];
$phonenumber = $_POST['phone-number'];
$recemail = $_POST['recemail'];
$recusername = $_POST['recusername'];
$recpassword = $_POST['recpassword'];
$recconfirm_password = $_POST['recconfirm_password'];
$privilege="receptionist";
$status="1";

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
}elseif(!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $recemail) || empty($recemail))
{
    echo $error="13";
}elseif(checkemailexistence($con, $recemail))
{
    echo $error="14";
}elseif (!preg_match("/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $recusername) || empty($recusername)) {
    echo $error="15";
}elseif (checkusernameexistence($con, $recusername)) {
    echo $error="16";
}elseif(!preg_match("/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $recpassword) || empty($recpassword))
{
    echo $error="17";
}elseif(strcmp($recpassword, $recconfirm_password) != 0)
{
    echo $error="18";
}else{
    savedata($con,$recname,$recsurname,$recemail,$recusername,$recpassword,$recbirthday,$gender,$state,$city,$streetaddress,$phonenumber, $recphoto,$status,$privilege);
}
//echo $docposition.$docname.$docsurname.$docbirthday.$gender.$state.$city.$streetaddress.$phonenumber.$docspecialization.$doctordepartament.$adressKDoc.$consultfee.$docemail.$docusername.$docpassword.$docconfirm_password;
}

function savedata($con,$recname,$recsurname,$recemail,$recusername,$recpassword,$recbirthday,$gender,$state,$city,$streetaddress,$phonenumber, $recphoto,$status,$privilege)
{
    $today = date("Y-m-d h:i:sa");
    $password = password_hash($recpassword, PASSWORD_BCRYPT);
    $photo = addslashes($recphoto);
    $query = mysqli_query($con,"INSERT INTO users(name,surname,email,username,password,birthday,gender,state,city,street_address,phone,privilege,photo,status,registered,last_updated) 
    VALUES('$recname','$recsurname','$recemail','$recusername','$password','$recbirthday','$gender','$state','$city','$streetaddress','$phonenumber','$privilege','$photo','$status','$today','$today')");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query));
    } else {

                $extra = "../add-receptionist.php"; //
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                echo "http://".$host.$uri."/".$extra."?edit=success";
    
    }
}

function checkemailexistence($con, $email)
    {
        $query = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
        $data = mysqli_fetch_array($query);
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            if ($data > 0) {
                    return true; //email exists
            } else {
                return false;
            }
        }
    }
    function checkusernameexistence($con, $username)
    {
        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
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
