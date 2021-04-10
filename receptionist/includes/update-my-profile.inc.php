<?php
include('config.php');
session_start();
error_reporting(0);
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

function lookotherElements($con,$docphoto)
{
    $fileContent=$docphoto;
    $id=$_SESSION['id'];
    $u_name = $_POST['nameAdmin'];
    $u_surname = $_POST['surnameAdmin'];
    $u_birthday = $_POST['adminstart_date'];
    $u_gender = $_POST['admingender'];
    $u_state = $_POST['stateaddress'];
    $u_city = $_POST['cityaddress'];
    $u_street = $_POST['streetAddress'];
    $u_phone = $_POST['adminPhone'];
    $u_email = $_POST['Adminemail'];
    $u_username = $_POST['adminusername'];
    $u_oldadminpsw = $_POST['oldadminpassword'];
    $u_adminpsw = $_POST['adminpassword'];
    $u_confpsw = $_POST['adminconfirm_password'];
    function validation($form_data)
    {
        $form_data = trim(stripcslashes(htmlspecialchars($form_data)));
        return $form_data;
    }

    $name = validation($u_name);
    $surname = validation($u_surname);
    $birthday = $u_birthday;
    $gender = $u_gender;
    $state = validation($u_state);
    $city = validation($u_city);
    $street = validation($u_street);
    $phone = $u_phone;
    $email = validation($u_email);
    $username = validation($u_username);
    $oldadminpsw = $u_oldadminpsw;
    $adminpsw = $u_adminpsw;
    $confpsw = $u_confpsw;
//check extension of uploading image
if (empty($name) || (!preg_match("/^([a-zA-Z' ]+)$/", $name))) {
    echo $error="2";
}elseif(empty($surname) || (!preg_match("/^([a-zA-Z' ]+)$/", $surname)))
{
    echo $error="3";
}elseif(empty($birthday))
{echo $error="4";
}elseif(empty($gender))
{
    echo $error="5";
}elseif (empty($state)) {
    echo $error="6";
} elseif (empty($city)) {
    echo $error="7";
} elseif (empty($street)) {
    echo $error="8";
} elseif (empty($phone)) {
    echo $error="9";
}elseif(!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email) || empty($email))
{
    echo $error="10";
}elseif(checkemailexistence($con, $email))
{
    echo $error="11";
}elseif (!preg_match("/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $username) || empty($username)) {
    echo $error="12";
}elseif (checkusernameexistence($con, $username)) {
    echo $error="13";
}elseif (empty($oldadminpsw)) {
    if (!empty($adminpsw) || !empty($confpsw)) {
        echo $error="14";
    } else {
        //savedata
        //$url_photo = 'data:' . $fileType . ';base64,' . base64_encode($fileContent);
        //echo '<script>alert("Te dhenat u ruajten me sukses")</script>';

        savedata($con, $id, $fileContent, $name, $surname, $birthday, $gender, $state, $city, $street, $phone, $email, $username, $adminpsw);
    }
}elseif (checkpassword($con, $oldadminpsw, $id)) {
    if (!preg_match("/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $adminpsw) || empty($adminpsw)) {
        echo $error="16";
    } else {
        if (strcmp($adminpsw, $confpsw) == 0) {
            savedata($con, $id, $fileContent, $name, $surname, $birthday, $gender, $state, $city, $street, $phone, $email, $username, $adminpsw);
        } else {
            echo $error="17";
        }
    }
} else {
    echo $error="15";
}


}

function savedata($con, $id, $u_photo, $name, $surname, $birthday, $gender, $state, $city, $street, $phone, $email, $username, $adminpsw)
    {
        $alert = "Te dhenat u ruajten me sukses.";
        $query = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
        $data = mysqli_fetch_array($query);
        $lastupdated = $data['last_updated'];
        $today = date("Y-m-d H:i:sa");
        //if($lastupdated==$today)
        if (false) {
            $alert = "Mund te ndryshoni te dhenat vetem nje here brenda dites.";
            echo "<script>
            alert('" . $alert . "');
            window.location.href='my-profile.php';
      </script>";
        } else {
            if (empty($adminpsw)) {
                $query = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
                $data = mysqli_fetch_array($query);
                $password1 = $data['password'];
            } else {
                $password1 = password_hash($adminpsw, PASSWORD_BCRYPT);
                $alert = "Paswordi dhe " . strtolower($alert);
            }
            if (empty($u_photo)) {
                $query2 = mysqli_query($con, "UPDATE users SET name='$name' , surname='$surname', email='$email', username='$username', password='$password1', birthday='$birthday', gender='$gender', state='$state', city='$city', street_address='$street', phone='$phone', last_updated='$today' WHERE id='$id'");
            } else {
                $photo = addslashes($u_photo);
                $query2 = mysqli_query($con, "UPDATE users SET name='$name' , surname='$surname', email='$email', username='$username', password='$password1', birthday='$birthday', gender='$gender', state='$state', city='$city', street_address='$street', phone='$phone', photo='$photo', last_updated='$today' WHERE id='$id'");
                $alert = "Fotografija, " . strtolower($alert);
            }
            $data = mysqli_fetch_array($query2);
            if (!$query2) {
                die("E pamundur te azhurohen te dhenat: " . mysqli_errno($query2));
            } else {
                $_SESSION['login'] = $username;
                $extra = "../my-profile.php"; //
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                echo "http://" . $host . $uri . "/" . $extra . "?edit=success";
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
                if (strcmp($data['username'], $_SESSION["login"]) == 0) {
                    return false;
                } else {
                    return true; //email exists
                }
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
                if (strcmp($data['username'], $_SESSION["login"]) == 0) {
                    return false;
                } else {
                    return true; //username exists
                }
            } else {
                return false;
            }
        }
    }

    function checkpassword($con, $pasword, $id)
    {
        $validimi = false;
        $oldpass = $pasword;
        $query = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
        $data = mysqli_fetch_array($query);
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            if ($data > 0) {
                $dbpsw = $data['password'];
                if (password_verify($oldpass, $dbpsw)) {
                    $validimi = true;
                }
            } else {
            }
        }
        return $validimi; //psw gabim
    }
?>
