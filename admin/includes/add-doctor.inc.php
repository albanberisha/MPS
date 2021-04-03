<?php
include('config.php');
$message="empty";
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
        lookotherElements($con, $docphoto);
    }
}else{
    lookotherElements($con, $docphoto);
}
//$fileContent = file_get_contents($_FILES['file']['tmp_name']);
function lookotherElements($con,$docphoto)
{
$docposition = $_POST['Doctorposition'];//
$docname = $_POST['nameDoc'];//
$docsurname = $_POST['surnameDoc'];//
$docbirthday = $_POST['docstart_date'];//
$gender = $_POST['docgender'];
$state = $_POST['stateaddress'];//
$city = $_POST['cityaddress'];//
$streetaddress = $_POST['streetAddress'];//
$phonenumber = $_POST['phone-number'];//
$docspecialization = $_POST['Doctorspecialization'];
$doctordepartament = $_POST['Doctordepartament'];
$adressKDoc = $_POST['adressKDoc'];
$consultfee = $_POST['Consultfee'];
$docemail = $_POST['docemail'];//
$docusername = $_POST['docusername'];//
$docpassword = $_POST['docpassword'];//
$docconfirm_password = $_POST['docconfirm_password'];
$status="1";

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
}elseif(empty($docspecialization))
{
    echo $error="10";
}elseif(empty($doctordepartament))
{
    echo $error="11";
}elseif($consultfee<0)
{
    echo $error="12";
}elseif(!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $docemail) || empty($docemail))
{
    echo $error="13";
}elseif(checkemailexistence($con, $docemail))
{
    echo $error="14";
}elseif (!preg_match("/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $docusername) || empty($docusername)) {
    echo $error="15";
}elseif (checkusernameexistence($con, $docusername)) {
    echo $error="16";
}elseif(!preg_match("/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $docpassword) || empty($docpassword))
{
    echo $error="17";
}elseif(strcmp($docpassword, $docconfirm_password) != 0)
{
    echo $error="18";
}else{
    savedata($con,$docname,$docsurname,$docemail,$docusername,$docpassword,$docbirthday,$gender,$state,$city,$streetaddress,$phonenumber,$docposition, $docphoto,$status,$docspecialization,$adressKDoc,$consultfee,$doctordepartament);
}
//echo $docposition.$docname.$docsurname.$docbirthday.$gender.$state.$city.$streetaddress.$phonenumber.$docspecialization.$doctordepartament.$adressKDoc.$consultfee.$docemail.$docusername.$docpassword.$docconfirm_password;
}


function savedata($con,$docname,$docsurname,$docemail,$docusername,$docpassword,$docbirthday,$gender,$state,$city,$streetaddress,$phonenumber,$docposition, $docphoto,$status,$docspecialization,$adressKDoc,$consultfee,$doctordepartament)
{
    $today = date("Y-m-d h:i:sa");
    $password = password_hash($docpassword, PASSWORD_BCRYPT);
    $photo = addslashes($docphoto);
    $query = mysqli_query($con,"INSERT INTO users(name,surname,email,username,password,birthday,gender,state,city,street_address,phone,privilege,photo,status,registered,last_updated) VALUES('$docname','$docsurname','$docemail','$docusername','$password','$docbirthday','$gender','$state','$city','$streetaddress','$phonenumber','$docposition','$photo','$status','$today','$today')");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query));
    } else {
        $query = mysqli_query($con, "SELECT id FROM users where username='$docusername'");
        $data=mysqli_fetch_array($query);
        if($data>0)
        {
            $userid=$data['id'];
            $query2 = mysqli_query($con,"INSERT INTO doctors(userId,specialties,position,clinic_address,consultancy_fees,departament) VALUES('$userid','$docspecialization','$docposition','$adressKDoc','$consultfee','$doctordepartament')");
            if (!$query2) {
                die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query2));
            } else {
                $extra = "../add-doctor.php"; //
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                echo "http://".$host.$uri."/".$extra."?add=success";
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