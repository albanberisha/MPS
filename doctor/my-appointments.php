<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 1(60 min) hours of inactivity
$minutesBeforeSessionExpire = 60;
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
$myid = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Terminet e mija</title>
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
                <p>Doctor | Terminet e mija</p>
            </div>
            <div class="container-fullw">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <div class="col-md-12">
                            <div class="card">
                                <div style="padding-bottom: 0;">
                                    <h6 class="panel-title panel-white text-center col-header">Terminet e mija</h6>
                                </div>
                                <div class="card-body card-top">
                                <p id="Deleteerror" style="color:red;"></p>
                                    <table class="data-list min-height dignosis color-none">
                                        <tbody id="Appointments">
                                        <tr>
                                                <th class="panel-title  date3">
                                                    Data:
                                                </th>
                                                <th class="panel-title date3">
                                                    Ora:
                                                </th>
                                                <th class="panel-title title4 ">
                                                    Doktori:
                                                </th>
                                                <th class="panel-title title4 ">
                                                    Pacienti:
                                                </th>
                                                <th class="panel-title title4 ">
                                                    ID:
                                                </th>
                                                <th class="panel-title title4 ">
                                                Statusi
                                                </th>
                                            </tr>
                                            <?php
                                            $querypast = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date<CURDATE() and appointments.status='approved' ORDER BY date ASC, starttime ASC LIMIT 50");
                                            $querytoday = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date=CURDATE() and appointments.status='approved' ORDER BY date ASC, starttime ASC");
                                            $querytodayfinished = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date=CURDATE() and appointments.status='finished' ORDER BY date ASC, starttime ASC");
                                            $querycomming = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date>CURDATE() and appointments.status='approved' ORDER BY date ASC, starttime ASC LIMIT 25");
                                            if (!$querytoday) {
                                                die(mysqli_error($con) . $querytoday);
                                            } else {
                                                while ($datatoday = mysqli_fetch_array($querytoday)) {
                                            ?>
                                                    <tr>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($datatoday['date']) ?>
                                                        </td>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($datatoday['starttime']) ?>-<?php echo htmlentities($datatoday['endtime']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datatoday['name']) ?> <?php echo htmlentities($datatoday['surname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datatoday['patname']) ?> <?php echo htmlentities($datatoday['patsurname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datatoday['patientID']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <button type="button"  onclick="finishAppointment(<?php echo $datatoday['id'] ?>);" class="btn btn-success" style="font-size: 10px;">Perfundo</button>
                                                        </td>
                                                    </tr>

                                                <?php
                                                }
                                            }
                                            if (!$querytodayfinished) {
                                                die(mysqli_error($con) . $querytodayfinished);
                                            } else {
                                                while ($datatodayfinished = mysqli_fetch_array($querytodayfinished)) {
                                            ?>
                                                    <tr>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($datatodayfinished['date']) ?>
                                                        </td>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($datatodayfinished['starttime']) ?>-<?php echo htmlentities($datatodayfinished['endtime']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datatodayfinished['name']) ?> <?php echo htmlentities($datatodayfinished['surname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datatodayfinished['patname']) ?> <?php echo htmlentities($datatodayfinished['patsurname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datatodayfinished['patientID']) ?>
                                                        </td>
                                                        <td class="title4">
                                                           Perfunduar
                                                        </td>
                                                    </tr>

                                                <?php
                                                }
                                            }
                                            if (!$querycomming) {
                                                die(mysqli_error($con) . $querycomming);
                                            } else {
                                                while ($datecomming = mysqli_fetch_array($querycomming)) {
                                                ?>
                                                    <tr>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($datecomming['date']) ?>
                                                        </td>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($datecomming['starttime']) ?>-<?php echo htmlentities($datecomming['endtime']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datecomming['name']) ?> <?php echo htmlentities($datecomming['surname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datecomming['patname']) ?> <?php echo htmlentities($datecomming['patsurname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datecomming['patientID']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            Aprovuar
                                                        </td>
                                                    </tr>

                                                <?php
                                                }
                                            }
                                            if (!$querypast) {
                                                die(mysqli_error($con) . $querypast);
                                            } else {
                                                while ($datepast = mysqli_fetch_array($querypast)) {
                                                ?>
                                                    <tr>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($datepast['date']) ?>
                                                        </td>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($datepast['starttime']) ?>-<?php echo htmlentities($datepast['endtime']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datepast['name']) ?> <?php echo htmlentities($datepast['surname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datepast['patname']) ?> <?php echo htmlentities($datepast['patsurname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datepast['patientID']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            Perfunduar
                                                        </td>
                                                    </tr>

                                            <?php
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
 function finishAppointment($id) {
            $confirm = confirm('A jeni te sigurte qe deshironi ta perfundoni terminin?');
        if($confirm)
        {
            table = 'appointments';
            $.ajax({
                    method: "POST",
                    url: "includes/delete.inc.php",
                    data: {
                        id: $id,
                        table: table
                    }
                })
                .done(function(response) {
                    if (response == "error") {
                        $('#Deleteerror').html("Perfundimi nuk lejohet!");
                    } else {
                        $('#Deleteerror').html("Termini u perfundua.");
                        $("#Appointments").html(response);
                    }
                });
            return false;
        }else{
            $('#Deleteerror').html("Perfundimi u anulua.");
        }            
        }

</script>