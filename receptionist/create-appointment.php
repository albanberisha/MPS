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

$patientId = null;
if (isset($_GET['closehistory'])) {
    $patientId = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Cakto nje termin</title>
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
                <p>Receptionist | Cakto nje termin</p>
            </div>
            <div class="container-fullw">
                <?php
                $exists = true;
                $query = mysqli_query($con, "SELECT patients.id FROM patients WHERE patients.status=1 and patients.id='$patientId' ");
                if (!$query) {
                    die(mysqli_error($con) . $query);
                } else {
                    $data = mysqli_fetch_array($query);
                    if ($data <= 0) {
                        $exists = false;
                    }
                }
                if ($patientId == NULL || !$exists) {
                    echo "Asgje per tu shfaqur";
                } else {
                    $_SESSION['userid'] = $patientId;
                    $query2 = mysqli_query($con, "SELECT patients.id,patients.name,patients.surname,patients.patientID,patients.birthday,patients.gender,patients.phone, patients.state,patients.city,patients.street_address,patients.email from patients where patients.id='$patientId'");
                    if (!$query2) {
                        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                    } else {
                        $data2 = mysqli_fetch_array($query2);
                        if ($data2 > 0) {
                ?>
                            <div class="panel-body no-padding" style="border: 1px solid green;">
                                <form method="POST" id="AddApointmentFrom" enctype="multipart/form-data">
                                    <div class="div-inlineflex">
                                        <div class="form-group">
                                            <label class="input-title" for="PatientName">
                                                Emri:
                                            </label>
                                            <input type="text" id="NamePatient" readonly="readonly" name="namePatient" class="form-control" placeholder="Sheno emrin e pacientit" value="<?php echo htmlentities($data2['name']) ?>">
                                            <span id="Nameerror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Mbiemri:</label>
                                            <input type="text" id="SurnamePatient" readonly="readonly" name="surnamePatient" class="form-control" placeholder="Sheno mbiemrin e pacientit" value="<?php echo htmlentities($data2['surname']) ?>">
                                            <span id="Surnameerror" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="patientId" class="input-title" style="margin-top: 7px;">ID:</label>
                                        <input type="number" id="IdPatient" name="idPatient" readonly="readonly" class="form-control" placeholder="Sheno ID" value="<?php echo htmlentities($data2['patientID']) ?>">
                                        <span id="IDerror" style="color: red;"></span>
                                    </div>
                                    <div class="div-inlineflex">
                                        <div class="form-group">
                                            <label class="input-title">Datelindja</label>
                                            <input type="date" class="form-control" id="Patientstart-date" readonly="readonly" name="patientstart_date" value="<?php echo htmlentities($data2['birthday']) ?>" />
                                            <span id="Birthdayerror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Gjinia</label>
                                            <div class="input-title-btn">
                                                <?php
                                                $gender = $data2['gender'];
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
                                            <input type="text" class="form-control" id="StateAddress" readonly="readonly" name="stateaddress" placeholder="Shteti" value="<?php echo htmlentities($data2['state']) ?>">
                                            <span id="Statedayerror" style="color: red;"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="input-title">Qyteti</label>
                                            <input type="text" class="form-control" id="CityAddress" readonly="readonly" readonly="readonly" name="cityaddress" placeholder="Qyteti" value="<?php echo htmlentities($data2['city']) ?>">
                                            <span id="Citydayerror" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Adresa e rruges</label>
                                        <input type="text" class="form-control" id="StreetAddress" name="streetAddress" readonly="readonly" placeholder="Adresa e rrugës" value="<?php echo htmlentities($data2['street_address']) ?>">
                                        <span id="Streetaddresserror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Numri i telefonit</label>
                                        <input class="form-control" readonly="readonly" id="phone-number" name="phone-number" value="<?php echo htmlentities($data2['phone']) ?>">
                                        <span id="Pronenumbererror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title" for="DoctorAppointment">
                                            Doktori:
                                        </label>
                                        <select name="DoctorAppointment" class="form-control doctorposition">
                                            <option selected value="">Zgjedh</option>
                                            <?php
                                            $query5 = mysqli_query($con, "SELECT doctors.id,doctors.userId, users.name, users.surname from doctors,users where doctors.userId=users.id and users.status='1'");
                                            if (!$query5) {
                                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                            } else {
                                                while ($data5 = mysqli_fetch_array($query5)) {
                                            ?>
                                                    <option value="<?php echo htmlentities($data5['userId']) ?>"><?php echo htmlentities($data5['name']) ?> <?php echo htmlentities($data5['surname']) ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span id="DoctorAppointmenterror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="input-title">Data:</label>
                                        <input type="date" class="form-control" id="ApointmentDate" name="apointmentDate" />
                                        <span id="ApointmentDateerror" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <p id="textm" style="display: block;">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e filimit te terminit:</label>
                                            <input type="time" class="form-control" id="ApointmentStartTime" name="apointmentStartTime">
                                            <span id="ApointmentStartTimeerror" style="color: red;"></span>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <p id="textm" style="display: block;">
                                            <label for="patientTime" class="input-title" style="margin-top: 7px;">Ora e mbarimit te terminit:</label>
                                            <input type="time" class="form-control" id="ApointmentEndTime" name="apointmentEndTime">
                                            <span id="ApointmentEndTimeerror" style="color: red;"></span>
                                        </p>
                                    </div>
                                    <div class="form-group" style="margin-top: 10px;">
                                        <button type="submit" class="btn btn-primary">Bej kerkes per termin</button>
                                    </div>
                                </form>
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
    $("#AddApointmentFrom").submit(function(e) {
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

        $('#DoctorAppointmenterror').html("");
        $('#ApointmentDateerror').html("");
        $('#ApointmentStartTimeerror').html("");
        $('#ApointmentEndTimeerror').html("");
        var myform = document.getElementById("AddApointmentFrom");
        var fd = new FormData(myform);
        $.ajax({
                url: "includes/create-appointments.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";
                error=response.substring(0,2);
                switch (error) {
                    case "10":
                        $message = "Zgjidh nje doktorr!";
                        $('#DoctorAppointmenterror').html($message);
                        document.getElementById('DoctorAppointmenterror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "11":
                        $message = "Data nuk mund te jete e zbrazet!";
                        $('#ApointmentDateerror').html($message);
                        document.getElementById('ApointmentDateerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "12":
                        $message = "Kjo date ka kaluar!";
                        $('#ApointmentDateerror').html($message);
                        document.getElementById('ApointmentDateerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "13":
                        $message = "Ora nuk mund te jete e zbrazet!";
                        $('#ApointmentStartTimeerror').html($message);
                        document.getElementById('ApointmentStartTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "14":
                        $message = "Ora ka kaluar!";
                        $('#ApointmentStartTimeerror').html($message);
                        document.getElementById('ApointmentStartTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "15":
                        $message = "Tashme egziston nje temrmin ne kete ore!<br> Termini me i afert i mundshem lidhur me oren e dhene eshte: "+response.substring(2,response.length);
                        $('#ApointmentStartTimeerror').html($message);
                        document.getElementById('ApointmentStartTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                        case "16":
                        $message = "Ora nuk mund te jete e zbrazet!";
                        $('#ApointmentEndTimeerror').html($message);
                        document.getElementById('ApointmentEndTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "17":
                        $message = "Shtypni oren me te madhe se ora e terminit!";
                        $('#ApointmentEndTimeerror').html($message);
                        document.getElementById('ApointmentEndTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "18":
                        $message = "Tashme egziston nje temrmin ne kete ore!<br> Maksimumi sa mund te zgjat termini eshte deri ne oren: "+response.substring(2,response.length);
                        $('#ApointmentEndTimeerror').html($message);
                        document.getElementById('ApointmentEndTimeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    default:
                        alert("Termini u shtua me sukses");
                        window.location.href = response;
                }
            });
        return false;
    });
</script>