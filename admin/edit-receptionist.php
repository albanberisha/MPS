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


$userid = null;
if (isset($_GET['edit'])) {
    $userid = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Ndrysho Detajet e Recepsionistit</title>
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
                <p>Admin | Ndrysho Detajet e Recepsionistit</p>
            </div>
            <div class=" container-fullw">
                <?php
                if ($userid == NULL) {
                    echo "Asgje per tu shfaqur";
                } else {
                    $_SESSION['userid'] = $userid;
                    $query = mysqli_query($con, "SELECT name, surname, state, city,street_address, birthday, gender, phone, email, username, photo, registered, last_updated FROM users where id='$userid' and status=1");
                    if (!$query) {
                        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                    } else {
                        $data = mysqli_fetch_array($query);
                        if ($data > 0) {
                ?>
                            <div class="panel-body">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><?php echo htmlentities($data['name']) ?> <?php echo htmlentities($data['surname']) ?></h5>
                                    <div class="info-panel">
                                        <div class="d-inline-flex">
                                            <h6 class="panel-title">Regjistruar me:</h6>
                                            <p class="reg-date"><?php echo htmlentities($data['registered']) ?></p>
                                        </div>
                                        <div class="d-inline-flex">
                                            <h6 class="panel-title">Hera e fundit e perditesimit:</h6>
                                            <p class="update-date"><?php echo htmlentities($data['last_updated']) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-form">
                                    <form id="EditReceptionistFrom" enctype="multipart/form-data">
                                        <div class="circle form-group">
                                            <div class="input-formimg">
                                                <?php
                                                if ($data['photo'] == Null) {
                                                ?>
                                                    <img id="preview" class="circle" src="../img/empty-img.png">
                                                <?php
                                                } else {

                                                    echo '<img id="preview" class="circle" src="data:image/jpeg;base64,' . base64_encode($data['photo']) . '" />  ';
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
                                                <label class="input-title">Emri i recepsionistit</label>
                                                <input type="text" id="nameRec" name="nameRec" class="form-control" placeholder="Sheno emrin e recepsionistit" value="<?php echo htmlentities($data['name']) ?>">
                                                <span id="Nameerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Mbiemri i recepsionistit</label>
                                                <input type="text" id="surnameRec" name="surnameRec" class="form-control" placeholder="Sheno mbiemrin e recepsionistit" value="<?php echo htmlentities($data['surname']) ?>">
                                                <span id="Surnameerror" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="div-inlineflex">
                                            <div class="form-group">
                                                <label class="input-title">Datelindja</label>
                                                <input type="date" class="form-control" id="Recstart-date" name="recstart_date" value="<?php echo htmlentities($data['birthday']) ?>" />
                                                <span id="Birthdayerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Gjinia</label>
                                                <div class="input-title-btn">
                                                    <?php
                                                    $gender = $data['gender'];
                                                    if (strcmp($gender, 'm') == 0) {
                                                    ?>
                                                        <input type="radio" name="recgender" value="m" checked> Mashkull<br>
                                                        <input type="radio" name="recgender" value="f"> Femër
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input type="radio" name="recgender" value="m"> Mashkull<br>
                                                        <input type="radio" name="recgender" value="f" checked> Femër
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
                                                <input type="text" class="form-control" id="StateAddress" name="stateaddress" placeholder="Shteti" value="<?php echo htmlentities($data['state']); ?>">
                                                <span id="Statedayerror" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="input-title">Qyteti</label>
                                                <input type="text" class="form-control" id="CityAddress" name="cityaddress" placeholder="Qyteti" value="<?php echo htmlentities($data['city']); ?>">
                                                <span id="Citydayerror" style="color: red;"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Adresa e rruges</label>
                                            <input type="text" class="form-control" id="StreetAddress" name="streetAddress" placeholder="Adresa e rrugës" value="<?php echo htmlentities($data['street_address']); ?>">
                                            <span id="Streetaddresserror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Numri i telefonit</label>
                                            <input class="form-control" id="phone-number" name="phone-number" value="<?php echo htmlentities($data['phone']) ?>">
                                            <span id="Pronenumbererror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Emaili</label>
                                            <input type="email" readonly="readonly" class="form-control" name="recemail" placeholder="Emaili"  value="<?php echo htmlentities($data['email']) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Username</label>
                                            <input type="text" class="form-control" name="recusername" placeholder="Username" value="<?php echo htmlentities($data['username']) ?>">
                                            <span id="Usernameerror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group" style="margin-top: 10px;">
                                            <button type="submit" class="btn btn-primary">Ndrysho</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>


<script>
$("#EditReceptionistFrom").submit(function(e) {
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
        $('#Usernameerror').html("");
        var myform = document.getElementById("EditReceptionistFrom");
    var fd = new FormData(myform );
    $.ajax({
        url: "includes/update-receptionist.inc.php",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        method: 'POST'
    })
    .done(function(response) {
        $message="";
        switch(response) {
  case "1":
    $message="Kerkohen formatet: png, gif, jpeg, jpg. Si dhe madhesia e limituar.";
    $('#Imageerror').html($message);
    document.getElementById('Imageerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
  case "2":
    $message="Emri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
    $('#Nameerror').html($message);
    document.getElementById('Nameerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "3":
    $message="Mbiemri duhet te permbaje vetem shkronja dhe nuk mund te jete i zbrazet!";
    $('#Surnameerror').html($message);
    document.getElementById('Surnameerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "4":
    $message="Nuk duhet te jete i zbrazet!";
    $('#Birthdayerror').html($message);
    document.getElementById('Birthdayerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "5":
    $message="Zgjidhni njeren nga opsionet!";
    $('#Gendererror').html($message);
    document.getElementById('Gendererror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "6":
    $message="Shenoni shtetin!";
    $('#Statedayerror').html($message);
    document.getElementById('Statedayerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "7":
    $message="Shenoni qytetin!";
    $('#Citydayerror').html($message);
    document.getElementById('Citydayerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "8":
    $message="Shenoni adresen!";
    $('#Streetaddresserror').html($message);
    document.getElementById('Streetaddresserror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "9":
    $message="Shenoni numrin e telefonit!";
    $('#Pronenumbererror').html($message);
    document.getElementById('Pronenumbererror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "15":
    $message="Username duhet te jete 5-20 karaktere, jo _ dhe . ne fillim apo ne fund!";
    $('#Usernameerror').html($message);
    document.getElementById('Usernameerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
    case "16":
    $message="Ky username ekziston.";
    $('#Usernameerror').html($message);
    document.getElementById('Usernameerror').scrollIntoView({ behavior: 'smooth', block: 'center' });
    break;
  default: alert("Te dhenat u ndryshuan me sukses.");
  window.location.href=response;
}
        });
        return false;
    });

</script>