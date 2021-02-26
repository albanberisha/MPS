<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 6(360 min) hours of inactivity
$minutesBeforeSessionExpire = 360;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))) {
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
    function checkpassword($con, $pasword, $username)
    {
        $validimi = false;
        $oldpass = $pasword;
        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
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

    function savedata($con, $u_photo, $name, $surname, $birthday, $gender, $state, $city, $street, $phone, $email, $username, $adminpsw)
    {
        $alert="Te dhenat u ruajten me sukses.";
        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
        $data = mysqli_fetch_array($query);
        $lastupdated=$data['last_updated'];
        $today= date("Y-m-d");
        //if($lastupdated==$today)
        if(false)
        {
            $alert="Mund te ndryshoni te dhenat vetem nje here brenda dites.";
            echo "<script>
            alert('".$alert."');
            window.location.href='my-profile.php';
      </script>";
        }else{
            if (empty($adminpsw)) {
                $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
                $data = mysqli_fetch_array($query);
                $password1 = $data['password'];
            } else {
                $password1 = password_hash($adminpsw, PASSWORD_BCRYPT);
                $alert="Paswordi dhe ".strtolower($alert);
    
            }
            $today = date("Y-m-d");
            if (empty($u_photo)) {
                $query2 = mysqli_query($con, "UPDATE users SET name='$name' , surname='$surname', email='$email', username='$username', password='$password1', birthday='$birthday', gender='$gender', state='$state', city='$city', street_address='$street', phone='$phone', last_updated='$today' WHERE username='$username'");
            } else {
                $photo = addslashes($u_photo);
                $query2 = mysqli_query($con, "UPDATE users SET name='$name' , surname='$surname', email='$email', username='$username', password='$password1', birthday='$birthday', gender='$gender', state='$state', city='$city', street_address='$street', phone='$phone', photo='$photo', last_updated='$today' WHERE username='$username'");
                $alert="Fotografija, ".strtolower($alert);
    
            }
                    $data = mysqli_fetch_array($query2);
            if (!$query2) {
                die("E pamundur te azhurohen te dhenat: " .mysqli_errno($query2));
            } else {
                $extra = "my-profile.php"; //
                $host = $_SERVER['HTTP_HOST'];
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                echo "<script>
            alert('".$alert."');
            window.location.href='http://".$host.$uri."/".$extra."?edit=success';
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
            $photo1=addslashes($u_photo);
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
            } elseif (empty($name) || (!preg_match("/^[a-zA-Z ]/", $name))) {
                $name_error = "Emri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
            } elseif (empty($surname) || (!preg_match("/^[a-zA-Z ]/", $surname))) {
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

                    savedata($con, $fileContent, $name, $surname, $birthday, $gender, $state, $city, $street, $phone, $email, $username, $adminpsw);
                }
            } elseif (checkpassword($con, $oldadminpsw, $username)) {
                if (!preg_match("/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $adminpsw) || empty($adminpsw)) {
                    $psw1error = "Paswordi duhet t'i permbaje 8 karaktere, se paku nje shkronje dhe nje numer.";
                } else {
                    if (strcmp($adminpsw, $confpsw) == 0) {
                        savedata($con, $fileContent, $name, $surname, $birthday, $gender, $state, $city, $street, $phone, $email, $username, $adminpsw);
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
                                        if($userdata['photo']==Null)
                                        {}else{
                                        echo '<img id="preview" class="circle" src="data:image/jpeg;base64,' . base64_encode($userdata['photo']) . '" />  ';
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group my-3">
                                    <div class="input-formimg">
                                        <input type="file" id="file" name="file" accept="image/*" />
                                    </div>
                                    <div class="input-formimg">
                                        <span style="color: red;"><?php echo  @$image_error; ?></span>
                                    </div>
                                </div>
                                <div class="div-inlineflex">
                                    <div class="form-group">
                                        <label class="input-title">Emri</label>
                                        <input type="text" id="NameAdmin" name="nameAdmin" placeholder="Emri" class="form-control" value="<?php echo htmlentities($userdata['name']); ?>">
                                        <span style="color: red;"><?php echo @$name_error; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Mbiemri</label>
                                        <input type="text" id="SurnameAdmin" name="surnameAdmin" placeholder="Mbiemri" class="form-control" value="<?php echo htmlentities($userdata['surname']); ?>">
                                        <span style="color: red;"><?php echo @$surname_error; ?></span>
                                    </div>
                                </div>
                                <div class="div-inlineflex">
                                    <div class="form-group">
                                        <label class="input-title">Datelindja</label>
                                        <input type="date" class="form-control" id="Adminstart-date" name="adminstart_date" value="<?php echo htmlentities($userdata['birthday']); ?>" />
                                        <span style="color: red;"><?php echo @$birthday_error; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Gjinia</label>
                                        <div class="input-title-btn">
                                            <?php
                                            $gender = htmlentities($userdata['gender']);
                                            if ($gender != null) {
                                                if (strcmp($gender, 'm') == 0) {
                                            ?>
                                                    <input type="radio" name="admingender" value="male" checked> Mashkull<br>
                                                    <input type="radio" name="admingender" value="female"> Femër
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="radio" name="admingender" value="male"> Mashkull<br>
                                                    <input type="radio" name="admingender" value="female" checked> Femër <?php
                                                                                                                        }
                                                                                                                    } else {
                                                                                                                            ?>
                                                <input type="radio" name="admingender" value="male"> Mashkull<br>
                                                <input type="radio" name="admingender" value="female"> Femër
                                            <?php
                                                                                                                    }
                                            ?>
                                            <span style="color: red;"><?php echo @$gender_error; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="div-inlineflex">
                                    <div class="form-group">
                                        <label class="input-title">Shteti</label>
                                        <input type="text" class="form-control" id="StateAddress" name="stateaddress" placeholder="Shteti" value="<?php echo htmlentities($userdata['state']); ?>">
                                        <span style="color: red;"><?php echo @$state_error; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Qyteti</label>
                                        <input type="text" class="form-control" id="CityAddress" name="cityaddress" placeholder="Qyteti" value="<?php echo htmlentities($userdata['city']); ?>">
                                        <span style="color: red;"><?php echo @$city_error; ?></span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Adresa e rruges</label>
                                    <input type="text" class="form-control" id="StreetAddress" name="streetAddress" placeholder="Adresa e rrugës" value="<?php echo htmlentities($userdata['street_address']); ?>">
                                    <span style="color: red;"><?php echo @$streetaddress_error; ?></span>
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Numri i telefonit</label>
                                    <input class="form-control" id="phone-number" name="adminPhone" value="<?php echo htmlentities($userdata['phone']); ?>">
                                    <span style="color: red;"><?php echo @$phone_error; ?></span>
                                </div>

                                <div class="register-div-info">
                                    <div class="form-group">
                                        <label class="input-title">Emaili</label>
                                        <input type="email" autocomplete="" class="form-control" name="Adminemail" placeholder="Emaili" value="<?php echo htmlentities($userdata['email']); ?>">
                                        <span style="color: red;"><?php echo @$email_error; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Username</label>
                                        <input type="text" autocomplete="" class="form-control" id="adminusername" name="adminusername" placeholder="Username" value="<?php echo htmlentities($userdata['username']); ?>">
                                        <span style="color: red;"><?php echo @$username_error; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Paswordi i vjeter</label>
                                        <input type="password" autocomplete="" class="form-control" name="oldadminpassword" placeholder="Paswordi">
                                        <span style="color: red;"><?php echo @$oldpsw1error; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Paswordi i ri</label>
                                        <input type="password" autocomplete="" class="form-control" name="adminpassword" placeholder="Paswordi">
                                        <span style="color: red;"><?php echo @$psw1error; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Perserit paswordin</label>
                                        <input type="password" autocomplete="" class="form-control" name="adminconfirm_password" placeholder="Perserit paswordin">
                                        <span style="color: red;"><?php echo @$psw2_error; ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group" style="margin-top: 10px;">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Ndrysho</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

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