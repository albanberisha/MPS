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
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doktor | Profili im</title>
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
        <?php include('includes/header.php');?>
        <hr style="margin-top:0px;">
    </header>
    <div class="" style="display: flex; margin-top: -16px; width: 100%;">
        <?php include('includes/sidebar.php');?>

        <div class="page" style="width: 100%;">
            <div class="card-header">
                <p>Doktor | Profili im</p>
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
                                        <input type="text" id="NameDoc" name="nameDoc" placeholder="Emri" class="form-control" value="<?php echo htmlentities($userdata['name']); ?>">
                                        <span id="Nameerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Mbiemri</label>
                                        <input type="text" id="SurnameDoc" name="surnameDoc" placeholder="Mbiemri" class="form-control" value="<?php echo htmlentities($userdata['surname']); ?>">
                                        <span id="Surnameerror" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="div-inlineflex">
                                    <div class="form-group">
                                        <label class="input-title">Datelindja</label>
                                        <input type="date" class="form-control" id="Docstart-date" name="docstart_date" value="<?php echo htmlentities($userdata['birthday']); ?>" />
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
                                                    <input type="radio" name="docgender" value="m" checked> Mashkull<br>
                                                    <input type="radio" name="docgender" value="f"> Femër
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="radio" name="docgender" value="m"> Mashkull<br>
                                                    <input type="radio" name="docgender" value="f" checked> Femër <?php
                                                                                                                }
                                                                                                            } else {
                                                                                                                    ?>
                                                <input type="radio" name="docgender" value="m"> Mashkull<br>
                                                <input type="radio" name="docgender" value="f"> Femër
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
                                    <input class="form-control" id="phone-number" name="docPhone" value="<?php echo htmlentities($userdata['phone']); ?>">
                                    <span id="Pronenumbererror" style="color: red;"></span>
                                </div>
                                <div class="register-div-info">
                                    <div class="form-group">
                                        <label class="input-title">Emaili</label>
                                        <input type="email" autocomplete="" class="form-control" name="docemail" placeholder="Emaili" value="<?php echo htmlentities($userdata['email']); ?>">
                                        <span id="Emailerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Username</label>
                                        <input type="text" autocomplete="" class="form-control" id="docusername" name="docusername" placeholder="Username" value="<?php echo htmlentities($userdata['username']); ?>">
                                        <span id="Usernameerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Paswordi i vjeter</label>
                                        <input type="password" autocomplete="" class="form-control" name="olddocpassword" placeholder="Paswordi">
                                        <span id="Oldpassworderror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Paswordi i ri</label>
                                        <input type="password" autocomplete="" class="form-control" name="docpassword" placeholder="Paswordi">
                                        <span id="Passworderror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Perserit paswordin</label>
                                        <input type="password" autocomplete="" class="form-control" name="docconfirm_password" placeholder="Perserit paswordin">
                                        <span id="Password2error" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">Ndrysho</button>                            
                            </div>
                            <?php
                            }
                            ?>
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