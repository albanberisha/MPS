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

$patient = null;
if (isset($_GET['death'])) {
    $patient = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Regjistrim i pacientëve</title>
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
                <p>Receptionist</p>
            </div>
            <div class="container-fullw">
                <?php
                if ($patient == NULL) {
                    echo "Asgje per tu shfaqur";
                } else {
                    $_SESSION['userid'] = $patient;
                ?>
                    <div class="panel-body no-padding" style="border: 1px solid black;">
                        <div class="panel-heading">
                            <h5 class="panel-title panel-white text-center">Rast i vdekjes</h5>
                        </div>
                        <form method="POST" id="DeathFrom" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="example-datetime-local-input" class="input-title" style="margin-top: 7px;">Data:</label>
                                <div class="col-10">
                                    <input type="datetime" readonly="readonly" class="form-control" id="Reg-date" name="reg_date" value="<?php echo date(" Y-m-d H:i:sa "); ?>">
                                </div>
                            </div>
                            <?php
                            $query = mysqli_query($con, "SELECT patients.id, patients.name,patients.surname,patients.patientID, patients.birthday, patients.gender, patients.state,patients.city, patients.street_address, patients.phone from patients where patients.id='$patient' and patients.status='1'");
                            if (!$query) {
                                die(mysqli_error($con).$query);
                            } else {
                                $data = mysqli_fetch_array($query);
                                if ($data > 0) {
                            ?>
                                    <div class="div-inlineflex">
                                        <div class="form-group">
                                            <label class="input-title" for="PatientName">
                                                Emri i të ndjerit:
                                            </label>
                                            <input type="text" id="NamePatient" readonly="readonly" name="namePatient" class="form-control" placeholder="Sheno emrin e pacientit" value="<?php echo htmlentities($data['name']) ?>">
                                            <span id="Nameerror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Mbiemri i të ndjerit:</label>
                                            <input type="text" id="SurnamePatient" readonly="readonly" name="surnamePatient" class="form-control" placeholder="Sheno mbiemrin e pacientit" value="<?php echo htmlentities($data['surname']) ?>">
                                            <span id="Surnameerror" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="patientId" class="input-title" style="margin-top: 7px;">ID:</label>
                                        <input type="number" id="IdPatient" name="idPatient" readonly="readonly" class="form-control" placeholder="Sheno ID" value="<?php echo htmlentities($data['patientID']) ?>">
                                        <span id="IDerror" style="color: red;"></span>
                                    </div>
                                    <div class="div-inlineflex">
                                        <div class="form-group">
                                            <label class="input-title">Datelindja</label>
                                            <input type="date" class="form-control" id="Patientstart-date" readonly="readonly" name="patientstart_date" value="<?php echo htmlentities($data['birthday']) ?>" />
                                            <span id="Birthdayerror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Gjinia</label>
                                            <div class="input-title-btn">
                                                <?php
                                                $gender = $data['gender'];
                                                if (strcmp($gender, 'm') == 0) {
                                                ?>
                                                    <input type="radio" name="patgender" checked value="m" onclick="return false;"> Mashkull<br>
                                                    <input type="radio" name="patgender" value="f" onclick="return false;"> Femër
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="radio" name="patgender" value="m" onclick="return false;"> Mashkull<br>
                                                    <input type="radio" name="patgender" checked value="f" onclick="return false;"> Femër
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
                                            <input type="text" class="form-control" id="StateAddress" readonly="readonly" name="stateaddress" placeholder="Shteti" value="<?php echo htmlentities($data['state']) ?>">
                                            <span id="Statedayerror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Qyteti</label>
                                            <input type="text" class="form-control" id="CityAddress" readonly="readonly" readonly="readonly" name="cityaddress" placeholder="Qyteti" value="<?php echo htmlentities($data['city']) ?>">
                                            <span id="Citydayerror" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Adresa e rruges</label>
                                        <input type="text" class="form-control" id="StreetAddress" name="streetAddress" readonly="readonly" placeholder="Adresa e rrugës" value="<?php echo htmlentities($data['street_address']) ?>">
                                        <span id="Streetaddresserror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Numri i telefonit</label>
                                        <input class="form-control" readonly="readonly" id="phone-number" name="phone-number" value="<?php echo htmlentities($data['phone']) ?>">
                                        <span id="Pronenumbererror" style="color: red;"></span>
                                    </div>
                                    <div class="div-inlineflex">
                                        <div class="form-group">
                                            <label class="input-title">Data e vdekjes:</label>
                                            <input type="date" class="form-control" id="Patientdeathdate" name="patientdeathate" />
                                            <span id="Deathdateererror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e vdekjes:</label>
                                            <input type="time" class="form-control" id="DeathTimedate" name="deathTimedate" />
                                            <span id="DeathTimeererror" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Data e pranimit:</label>
                                        <input type="date" class="form-control" id="ReceiptDatedate" name="receiptDate" />
                                        <span id="ReceiptDateererror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title" for="DoctorRaporting">
                                            Doktori qe e raportoj vdekjen:
                                        </label>
                                        <select name="DoctorRaporting" class="form-control doctorposition">
                                            <option selected value="">Zgjedh</option>
                                            <?php
                                            $query = mysqli_query($con, "SELECT doctors.id,doctors.userId, users.name, users.surname from doctors,users where doctors.userId=users.id and users.status='1'");
                                            if (!$query) {
                                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                            } else {
                                                while ($data = mysqli_fetch_array($query)) {
                                            ?>
                                                    <option value="<?php echo htmlentities($data['userId']) ?>"><?php echo htmlentities($data['name']) ?> <?php echo htmlentities($data['surname']) ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span id="DocRaportingerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Pershkrimi i ngjarjeve para vekjes:</label>
                                        <textarea class="form-control" rows="5" id="DeathEvents" name="deathEvents" placeholder="Te dhenat si: detajet e ndonje operacioni ose ndonje procedure para vdekjes se bashku me datat relevante."></textarea>
                                        <span id="Deatheventserror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Shkaku i vdekjes(nese dihet)</label>
                                        <input type="text" class="form-control" id="deathCause" name="deathcause" placeholder="Shkaku i supozuar">
                                        <span id="DeathCauseerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group" style="margin-top: 10px;">
                                        <button type="submit" class="btn btn-primary">Mbaro</button>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </form>
                    </div>
            </div>


        <?php
                }
        ?>

        </div>
    </div>
</body>

</html>

<script>
    $("#DeathFrom").submit(function(e) {
        e.preventDefault();
        $('#Nameerror').html("");
        $('#Surnameerror').html("");
        $('#IDerror').html("");
        $('#Birthdayerror').html("");
        $('#Gendererror').html("");
        $('#Statedayerror').html("");
        $('#Citydayerror').html("");
        $('#Streetaddresserror').html("");
        $('#Pronenumbererror').html("");

        $('#Deathdateererror').html("");
        $('#DeathTimeererror').html("");
        $('#ReceiptDateererror').html("");
        $('#DocRaportingerror').html("");
        $('#Deatheventserror').html("");
        $('#DeathCauseerror').html("");
        var myform = document.getElementById("DeathFrom");
        var fd = new FormData(myform);
        $.ajax({
                url: "includes/death-patient.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";
                switch (response) {
                    case "10":
                        $message = "Data nuk mund te jete e zbrazet!";
                        $('#Deathdateererror').html($message);
                        document.getElementById('Deathdateererror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "11":
                        $message = "Ora nuk mund te jete e zbrazet!";
                        $('#DeathTimeererror').html($message);
                        document.getElementById('DeathTimeererror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "12":
                        $message = "Data nuk mund te jete e zbrazet!";
                        $('#ReceiptDateererror').html($message);
                        document.getElementById('ReceiptDateererror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "13":
                        $message = "Zgjidhni njeren nga opsionet!";
                        $('#DocRaportingerror').html($message);
                        document.getElementById('DocRaportingerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "14":
                        $message = "Nuk mund te jete e zbrazet!";
                        $('#Deatheventserror').html($message);
                        document.getElementById('Deatheventserror').scrollIntoView({
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