<?php
include('config.php');
$message="empty";
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
        lookotherElements($con, $infphoto);
    }
}else{
    lookotherElements($con, $infphoto);
}
//$fileContent = file_get_contents($_FILES['file']['tmp_name']);
function lookotherElements($con,$infphoto)
{
$name = $_POST['nameInf'];
$surname = $_POST['surnameInf'];
$birthday = $_POST['infstart_date'];
$gender = $_POST['infgender'];
$state = $_POST['stateaddress'];
$city = $_POST['cityaddress'];
$streetaddress = $_POST['streetAddress'];
$phonenumber = $_POST['phone-number'];
$departament = $_POST['Infermierdepartament'];
$email = $_POST['infemail'];
$username = $_POST['infusername'];
$password = $_POST['infpassword'];
$confirm_password = $_POST['infconfirm_password'];
$privilege="infirmier";
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
}elseif(empty($departament))
{
    echo $error="11";
}elseif(!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email) || empty($email))
{
    echo $error="13";
}elseif(checkemailexistence($con, $email))
{
    echo $error="14";
}elseif (!preg_match("/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $username) || empty($username)) {
    echo $error="15";
}elseif (checkusernameexistence($con, $username)) {
    echo $error="16";
}elseif(!preg_match("/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $password) || empty($password))
{
    echo $error="17";
}elseif(strcmp($password, $confirm_password) != 0)
{
    echo $error="18";
}else{
    savedata($con,$name,$surname,$email,$username,$password,$birthday,$gender,$state,$city,$streetaddress,$phonenumber, $infphoto,$status,$departament,$privilege);
}
//echo $infposition.$docname.$docsurname.$docbirthday.$gender.$state.$city.$streetaddress.$phonenumber.$docspecialization.$doctordepartament.$adressKDoc.$consultfee.$docemail.$docusername.$docpassword.$docconfirm_password;
}

function savedata($con,$name,$surname,$email,$username,$passwordd,$birthday,$gender,$state,$city,$streetaddress,$phonenumber, $infphoto,$status,$departament,$privilege)
{
    $today = date("Y-m-d h:i:sa");
    $password = password_hash($passwordd, PASSWORD_BCRYPT);
    $photo = addslashes($infphoto);
    $query = mysqli_query($con,"INSERT INTO users(name,surname,email,username,password,birthday,gender,state,city,street_address,phone,privilege,photo,status,registered,last_updated) VALUES ('$name','$surname','$email','$username','$password','$birthday','$gender','$state','$city','$streetaddress','$phonenumber','$privilege','$photo','$status','$today','$today')");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query));
    } else {
        $query = mysqli_query($con, "SELECT id FROM users where username='$username'");
        $data=mysqli_fetch_array($query);
        if($data>0)
        {
            $userid=$data['id'];
            $query2 = mysqli_query($con,"INSERT INTO infirmiers(userId,depId) VALUES('$userid','$departament')");
            if (!$query2) {
                die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query2));
            } else {
                $extra = "../add-infirmier.php"; //
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                echo "http://".$host.$uri."/".$extra."?edit=success";
            }
        }else{
            die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query));
        }
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