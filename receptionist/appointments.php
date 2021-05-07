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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Terminet</title>
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
                <p>Receptionist | Terminet</p>
            </div>
            <div class="container-fullw">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <div class="col-md-12">
                            <div class="card">
                                <div style="padding-bottom: 0;">
                                    <h6 class="panel-title panel-white text-center col-header">Terminet</h6>
                                </div>

                                <div class="card-body card-top">
                                    <table class="data-list min-height dignosis color-none">
                                        <tbody>
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
                                                    Telefoni:
                                                </th>
                                                <th class="panel-title title4 ">
                                                    Statusi:
                                                </th>
                                            </tr>
                                            <?php
                                            $query = mysqli_query($con, "SELECT appointments.date,appointments.starttime,appointments.endtime,appointments.status,patients.name as patientname,patients.surname as patientsurname,patients.phone,users.name as docname,users.surname as docsurname from appointments,patients,users where appointments.patientId=patients.id and appointments.doctorId=users.id and appointments.date>=CURDATE() ORDER by date ASC, starttime ASC LIMIT 50");
                                            if (!$query) {
                                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                            } else {
                                                while ($data = mysqli_fetch_array($query)) {
                                            ?>
                                                    <tr>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($data['date']) ?>
                                                        </td>
                                                        <td class=" date3">
                                                            <?php echo htmlentities($data['starttime']) ?>-<?php echo htmlentities($data['endtime']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($data['docname']) ?> <?php echo htmlentities($data['docsurname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($data['patientname']) ?> <?php echo htmlentities($data['patientsurname']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php echo htmlentities($data['phone']) ?>
                                                        </td>
                                                        <td class="title4">
                                                            <?php 
                                                            $status=$data['status'];
                                                            $statusi="";
                                                            switch($status)
                                                            {
                                                                case "approved":
                                                                    $statusi="Aprovuar";
                                                                    break;
                                                                    case "finished":
                                                                        $statusi="Pefunduar";
                                                                        break;
                                                                        case "rejected":
                                                                            $statusi="refuzuar";
                                                                            break;
                                                                            default:
                                                                                $statusi="";
                                                            }
                                                            echo $statusi;
                                                            ?>
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