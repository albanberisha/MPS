<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 6(360 min) hours of inactivity
$minutesBeforeSessionExpire = 360;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))) {
    $uname=$_SESSION["login"];
    $onlnine=mysqli_query($con,"UPDATE users SET users.online=0 WHERE username='$uname'");
    session_unset();     // unset $_SESSION   
    session_destroy();   // destroy session data 
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = "../index.php";
    $_SESSION["login"] = "";
    header("Location: http://$host$uri/$extra");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity

?>

<?php
/*
if (isset($_POST['submit'])) {
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

    function savedata($con, $id, $u_photo, $name, $surname, $birthday, $gender, $state, $city, $street, $phone, $email, $username, $adminpsw)
    {
        $alert = "Te dhenat u ruajten me sukses.";
        $query = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
        $data = mysqli_fetch_array($query);
        $lastupdated = $data['last_updated'];
        $today = date("Y-m-d h:i:sa");
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
                $extra = "my-profile.php"; //
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                echo "<script>
            alert('" . $alert . "');
            window.location.href='http://" . $host . $uri . "/" . $extra . "?edit=success';
         </script>";
            }
        }
    }



    function savedata1($con, $u_photo, $name, $surname, $birthday, $gender, $state, $city, $street, $phone, $email, $username, $adminpsw)
    {
        // prepare and bind
        $stmt = $con->prepare("UPDATE users SET name=? , surname=?, email=?, username=?, password=?, birthday=?, gender=?, state=?, city=?, street_address=?, phone=?, photo=?, last_updated=? WHERE username='$username'");
        $name1 = $name;
        $surname1 = $surname;
        $email1 = $email;
        $username1 = $username;
        if (empty($adminpsw)) {
            $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
            $data = mysqli_fetch_array($query);
            $password1 = $data['password'];
        } else {
            $password1 = password_hash($adminpsw, PASSWORD_BCRYPT);
        }
        $birthday1 = $birthday;
        $gender1 = $gender;
        $state1 = $state;
        $city1 = $city;
        $street1 = $street;
        $phone1 = $phone;
        if (empty($u_photo)) {

            $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
            $data = mysqli_fetch_array($query);
            $photo1 = $data['photo'];
        } else {
            $photo1 = addslashes($u_photo);
        }
        $updated = date("Y-m-d h:i:sa");
        $stmt->bind_param("sss", $name1, $surname1, $email1, $username1, $password1, $birthday1, $gender1, $state1, $city1, $street1, $phone1, $photo1, $updated);
        $stmt->execute();
        $stmt->close();
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {

            //$fileName = $_FILES['file']['name'];
            //$fileContent = file_get_contents($_FILES['file']['tmp_name']);

            $id = $_SESSION['id'];
            $fileContent = file_get_contents($_FILES['file']['tmp_name']);
            $fileType = $_FILES['file']['type'];
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
            if (($fileType != 'image/png' && $fileType != 'image/gif' && $fileType != 'image/jpeg' && $fileType != 'image/jpg') && !empty($fileContent)) {
                $image_error = $fileType . " nuk preferohet. Kerkohen formatet: png, gif, jpeg, jpg!";
            } elseif ($_FILES['file']['size'] > 10485760) { //10 MB (size is also in bytes)
                $image_error = " Keni tejkaluar madhesine e mundshme!";
            } elseif (empty($name) || (!preg_match("/^([a-zA-Z' ]+)$/", $name))) {
                $name_error = "Emri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
            } elseif (empty($surname) || (!preg_match("/^([a-zA-Z' ]+)$/", $surname))) {
                $surname_error = "Mbiemri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
            } elseif (empty($birthday)) {
                $birthday_error = "Nuk duhet te jete i zbrazet!";
            } elseif (empty($gender)) {
                $gender_error = "Zgjidhni njeren nga opsionet!";
            } elseif (empty($state)) {
                $state_error = "Shenoni shtetin!";
            } elseif (empty($city)) {
                $city_error = "Shenoni qytetin!";
            } elseif (empty($street)) {
                $streetaddress_error = "Shenoni adresen!";
            } elseif (empty($phone)) {
                $phone_error = "Shenoni numrin e telefonit!";
            } elseif (!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $email) || empty($email)) {
                $email_error = "Format i gabuar!";
            } elseif (checkemailexistence($con, $email)) {
                $email_error = "Ky email ekziston.";
            } elseif (!preg_match("/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $username) || empty($username)) {
                $username_error = "Username duhet te jete 5-20 karaktere, jo _ dhe . ne fillim apo ne fund.!";
            } elseif (checkusernameexistence($con, $username)) {
                $username_error = "Ky username ekziston.";
            } elseif (empty($oldadminpsw)) {
                if (!empty($adminpsw) || !empty($confpsw)) {
                    $oldpsw1error = "Shenoni paswordin e vjeter!";
                } else {
                    //savedata
                    //$url_photo = 'data:' . $fileType . ';base64,' . base64_encode($fileContent);
                    //echo '<script>alert("Te dhenat u ruajten me sukses")</script>';

                    savedata($con, $id, $fileContent, $name, $surname, $birthday, $gender, $state, $city, $street, $phone, $email, $username, $adminpsw);
                }
            } elseif (checkpassword($con, $oldadminpsw, $id)) {
                if (!preg_match("/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $adminpsw) || empty($adminpsw)) {
                    $psw1error = "Paswordi duhet t'i permbaje 8 karaktere, se paku nje shkronje dhe nje numer.";
                } else {
                    if (strcmp($adminpsw, $confpsw) == 0) {
                        savedata($con, $id, $fileContent, $name, $surname, $birthday, $gender, $state, $city, $street, $phone, $email, $username, $adminpsw);
                    } else {
                        $psw2_error = "Paswordat nuk perputhen 1.";
                    }
                }
            } else {
                $oldpsw1error = "Paswordi gabim!";
            }
        }
    }
}
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Profili im</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="js/imagebrowse.js"></script>
    <script src="js/input-masks.js"></script>
    <script>
        function reportWindowSize() {
            var widthOutput = window.innerWidth;
            if (widthOutput < 960) {
                $('.centered-name-1').addClass('active');
                $('.dropdown-content-1').addClass('active');
                $(".closebtn").css("display", "none");
                $(".openbtn").css("display", "inline");
                $(".sidenav").css("width", "60px");
            }
        }

        window.onresize = reportWindowSize;
    </script>
</head>

<body onload="reportWindowSize()">
    <header>
        <?php include('includes/header.php'); ?>
        <hr style="margin-top:0px;">
    </header>
    <div class="" style="display: flex; margin-top: -16px; width: 100%;">
        <?php include('includes/sidebar.php'); ?>

        <div class="page" style="width: 100%;">
            <div class="card-header">
                <p>Admin | Profili im</p>
            </div>
            <div class=" container-fullw">
                <div class="panel-body">
                    <div class="panel-heading">
                        <h5 class="panel-title">Profili im</h5>
                    </div>
                    <div class="panel-form">
                        <form method="POST" id="UserFrom" enctype="multipart/form-data">
                            <?php
                            $sql = mysqli_query($con, "SELECT * FROM users where id='" . $_SESSION['id'] . "'");
                            while ($userdata = mysqli_fetch_array($sql)) {
                            ?>
                                <div class="circle form-group">
                                    <div class="input-formimg">
                                        <?php
                                        if ($userdata['photo'] == Null) {
                                        ?>
                                            <img id="preview" class="circle" src="../img/empty-img.png">
                                        <?php
                                        } else {
                                            echo '<img id="preview" class="circle" src="data:image/jpeg;base64,' . base64_encode($userdata['photo']) . '" />  ';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" disabled placeholder="Ngarkoni fotografi" id="file">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary">Ngarkoni...</button>
                                        </div>
                                    </div>
                                    <span id="Imageerror" style="color: red;"></span>
                                    <input type="file" id="file2" name="file2" class="file" accept="image/png">
                                </div>
                                <div class="div-inlineflex">
                                    <div class="form-group">
                                        <label class="input-title">Emri</label>
                                        <input type="text" id="NameAdmin" name="nameAdmin" placeholder="Emri" class="form-control" value="<?php echo htmlentities($userdata['name']); ?>">
                                        <span id="Nameerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Mbiemri</label>
                                        <input type="text" id="SurnameAdmin" name="surnameAdmin" placeholder="Mbiemri" class="form-control" value="<?php echo htmlentities($userdata['surname']); ?>">
                                        <span id="Surnameerror" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="div-inlineflex">
                                    <div class="form-group">
                                        <label class="input-title">Datelindja</label>
                                        <input type="date" class="form-control" id="Adminstart-date" name="adminstart_date" value="<?php echo htmlentities($userdata['birthday']); ?>" />
                                        <span id="Birthdayerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Gjinia</label>
                                        <div class="input-title-btn">
                                            <?php
                                            $gender = htmlentities($userdata['gender']);
                                            if ($gender != null) {
                                                if (strcmp($gender, 'm') == 0) {
                                            ?>
                                                    <input type="radio" name="admingender" value="m" checked> Mashkull<br>
                                                    <input type="radio" name="admingender" value="f"> Femër
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="radio" name="admingender" value="m"> Mashkull<br>
                                                    <input type="radio" name="admingender" value="f" checked> Femër <?php
                                                                                                                }
                                                                                                            } else {
                                                                                                                    ?>
                                                <input type="radio" name="admingender" value="m"> Mashkull<br>
                                                <input type="radio" name="admingender" value="f"> Femër
                                            <?php
                                                                                                            }
                                            ?>
                                        </div>
                                        <span id="Gendererror" style="color: red;"></span>

                                    </div>
                                </div>
                                <div class="div-inlineflex">
                                    <div class="form-group">
                                        <label class="input-title">Shteti</label>
                                        <input type="text" class="form-control" id="StateAddress" name="stateaddress" placeholder="Shteti" value="<?php echo htmlentities($userdata['state']); ?>">
                                        <span id="Statedayerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Qyteti</label>
                                        <input type="text" class="form-control" id="CityAddress" name="cityaddress" placeholder="Qyteti" value="<?php echo htmlentities($userdata['city']); ?>">
                                        <span id="Citydayerror" style="color: red;"></span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Adresa e rruges</label>
                                    <input type="text" class="form-control" id="StreetAddress" name="streetAddress" placeholder="Adresa e rrugës" value="<?php echo htmlentities($userdata['street_address']); ?>">
                                    <span id="Streetaddresserror" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Numri i telefonit</label>
                                    <input class="form-control" id="phone-number" name="adminPhone" value="<?php echo htmlentities($userdata['phone']); ?>">
                                    <span id="Pronenumbererror" style="color: red;"></span>
                                </div>

                                <div class="register-div-info">
                                    <div class="form-group">
                                        <label class="input-title">Emaili</label>
                                        <input type="email" autocomplete="" class="form-control" name="Adminemail" placeholder="Emaili" value="<?php echo htmlentities($userdata['email']); ?>">
                                        <span id="Emailerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Username</label>
                                        <input type="text" autocomplete="" class="form-control" id="adminusername" name="adminusername" placeholder="Username" value="<?php echo htmlentities($userdata['username']); ?>">
                                        <span id="Usernameerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Paswordi i vjeter</label>
                                        <input type="password" autocomplete="" class="form-control" name="oldadminpassword" placeholder="Paswordi">
                                        <span id="Oldpassworderror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Paswordi i ri</label>
                                        <input type="password" autocomplete="" class="form-control" name="adminpassword" placeholder="Paswordi">
                                        <span id="Passworderror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Perserit paswordin</label>
                                        <input type="password" autocomplete="" class="form-control" name="adminconfirm_password" placeholder="Perserit paswordin">
                                        <span id="Password2error" style="color: red;"></span>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">Ndrysho</button>                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $("#UserFrom").submit(function(e) {
        e.preventDefault();
        $('#Imageerror').html("");
        $('#Nameerror').html("");
        $('#Surnameerror').html("");
        $('#Birthdayerror').html("");
        $('#Gendererror').html("");
        $('#Statedayerror').html("");
        $('#Citydayerror').html("");
        $('#Streetaddresserror').html("");
        $('#Pronenumbererror').html("");
        $('#Emailerror').html("");
        $('#Usernameerror').html("");
        $('#Oldpassworderror').html("");
        $('#Passworderror').html("");
        $('#Password2error').html("");

        var myform = document.getElementById("UserFrom");
        var fd = new FormData(myform);
        $.ajax({
                url: "includes/update-my-profile.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";

                switch (response) {
                    case "1":
                        $message = "Kerkohen formatet: png, gif, jpeg, jpg. Si dhe madhesia e limituar.";
                        $('#Imageerror').html($message);
                        document.getElementById('Imageerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "2":
                        $message = "Emri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
                        $('#Nameerror').html($message);
                        document.getElementById('Nameerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "3":
                        $message = "Mbiemri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
                        $('#Surnameerror').html($message);
                        document.getElementById('Surnameerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "4":
                        $message = "Nuk duhet te jete i zbrazet!";
                        $('#Birthdayerror').html($message);
                        document.getElementById('Birthdayerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "5":
                        $message = "Zgjidhni njeren nga opsionet!";
                        $('#Gendererror').html($message);
                        document.getElementById('Gendererror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "6":
                        $message = "Shenoni shtetin!";
                        $('#Statedayerror').html($message);
                        document.getElementById('Statedayerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "7":
                        $message = "Shenoni qytetin!";
                        $('#Citydayerror').html($message);
                        document.getElementById('Citydayerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "8":
                        $message = "Shenoni adresen!";
                        $('#Streetaddresserror').html($message);
                        document.getElementById('Streetaddresserror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "9":
                        $message = "Shenoni numrin e telefonit!";
                        $('#Pronenumbererror').html($message);
                        document.getElementById('Pronenumbererror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "10":
                        $message = "Format i gabuar!";
                        $('#Emailerror').html($message);
                        document.getElementById('Emailerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "11":
                        $message = "Ky email ekziston.!";
                        $('#Emailerror').html($message);
                        document.getElementById('Emailerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "12":
                        $message = "Username duhet te jete 5-20 karaktere, jo _ dhe . ne fillim apo ne fund!";
                        $('#Usernameerror').html($message);
                        document.getElementById('Usernameerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "13":
                        $message = "Ky username ekziston.";
                        $('#Usernameerror').html($message);
                        document.getElementById('Usernameerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "14":
                        $message = "Shenoni paswordin e vjeter!";
                        $('#Oldpassworderror').html($message);
                        document.getElementById('Oldpassworderror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "15":
                        $message = "Paswordi gabim!";
                        $('#Oldpassworderror').html($message);
                        document.getElementById('Oldpassworderror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "16":
                        $message = "Paswordi duhet t'i permbaje 8 karaktere, se paku nje shkronje dhe nje numer.";
                        $('#Passworderror').html($message);
                        document.getElementById('Passworderror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "17":
                        $message = "Paswordat nuk perputhen.";
                        $('#Password2error').html($message);
                        document.getElementById('Password2error').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    default:
                        alert("Te dhenat u ruajten me sukses");
                        window.location.href = response;
                }
            });
        return false;
    });
</script>

<script>
    /** 
$(document).ready(function(){
  $('#submit').click(function(e) {
    e.preventDefault();
    
    $.ajax({
      url: 'includes/update-user.php',
      type: 'POST',
      data: { 
          user : 'Tommy' },

      success: function(output){
        alert(output);
        $psw2_error = "Paswordat nuk perputhen 1.";
        $(self).html("Paswordat nuk perputhen 1.");
        $('#UserFrom')[0].reset();
      }
    });
  });
});
*/
</script>