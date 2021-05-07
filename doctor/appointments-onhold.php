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
    <title>Doctor | Terminet ne pritje</title>
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
                <p>Doctor | Terminet ne pritje</p>
            </div>
            <div class="container-fullw">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <div class="col-md-12">
                            <div class="card">
                                <div style="padding-bottom: 0;">
                                    <h6 class="panel-title panel-white text-center col-header">Terminet ne pritje</h6>
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
                                            $querycomming = mysqli_query($con, "SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.status='approved' and  appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date=CURDATE() and appointments.starttime>CURTIME() UNION SELECT appointments.id,appointments.date,appointments.starttime,appointments.endtime,appointments.doctorId as docid, users.name,users.surname,patients.id as patid, patients.patientID,patients.name as patname, patients.surname as patsurname, appointments.status from appointments,users,patients WHERE appointments.patientId=patients.id and appointments.status='approved' and  appointments.doctorId=users.id and appointments.doctorId='$myid' and appointments.date>CURDATE()  ORDER BY date ASC, starttime ASC");
                                            if (!$querycomming) {
                                                die(mysqli_error($con) . $querycomming);
                                            } else {
                                                while ($datacomming = mysqli_fetch_array($querycomming)) {
                                                    ?>
                                                    <tr>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($datacomming['date']) ?>
                                                        </td>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($datacomming['starttime']) ?>-<?php echo htmlentities($datacomming['endtime']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datacomming['name']) ?> <?php echo htmlentities($datacomming['surname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datacomming['patname']) ?> <?php echo htmlentities($datacomming['patsurname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($datacomming['patientID']) ?>
                                                        </td>
                                                        <td class="title4">
                                                        <button type="button" onclick="rejectAppointment(<?php echo $datacomming['id'] ?>);" class="btn btn-danger" style="font-size: 10px;">Anulo</button>
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
 function rejectAppointment($id) {
            $confirm = confirm('A jeni te sigurte qe deshironi ta anuloni terminin?');
        if($confirm)
        {
            table = 'appointments-reject';
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
                        $('#Deleteerror').html("Annulimi nuk lejohet!");
                    } else {
                        $('#Deleteerror').html("Termini u anulua.");
                        $("#Appointments").html(response);
                    }
                });
            return false;
        }else{
            $('#Deleteerror').html("Operacioni u anulua.");
        }            
        }

</script>