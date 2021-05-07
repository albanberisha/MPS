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
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Te dhenat e spitalit</title>
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
            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav navbar-pat">
                            <li class="nav-item active">
                                <button type="button" id="Summary" class="left-marg  btn btn-primary">Detaje të përgjithshme</button>
                            </li>
                            <li class="nav-item active">
                                <button type="button" id="LabResults" class=" left-marg  btn btn-primary">Menaxho dhomat</button>
                            </li>
                            <li class="nav-item active">
                                <button type="button" id="Diagnosis" class="left-marg  btn btn-primary">Menaxho departamentet</button>
                            </li>
                            <li class="nav-item active">
                                <button type="button" id="Pricing-list" class="left-marg  btn btn-primary">Qmimorja</button>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="container-fullw" id="container-fullw">
            <?php include('includes/hospital-details.php'); ?>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $("#Summary").click(function() {
            $("#container-fullw").load('includes/hospital-details.php');
        });
        $("#LabResults").click(function() {
            $("#container-fullw").load('includes/manage-rooms.php');
        });
        $("#Diagnosis").click(function() {
            $("#container-fullw").load('includes/manage-departaments.php');
        });
        $("#Pricing-list").click(function() {
            $("#container-fullw").load('includes/pricing-list.php');
        });
    });
</script>