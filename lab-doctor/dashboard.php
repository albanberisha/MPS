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
    <title>Doktor laboratori | Paneli i aparaturave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="js/imagebrowse.js"></script>
    <script>
        $(document).ready(function() {
            $('#widget li').on('click', function() {
                $(this).removeClass('new-ntf');
            });
        });
    </script>
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
            if (widthOutput < 1120) {
                closeChat();
            } else {}
        }

        var acc;
        function closeChat() {
            document.getElementById("Chatbox").style.display = "none";
            this.acc=0;

        }

        function openChat(from) {
            document.getElementById("Chatbox").style.display = "inline";
            
}
        window.onresize = reportWindowSize;
    </script>
    
</head>

<body onload="reportWindowSize()">
    <header>
        <?php 
                define('SECURE_PAGE', true);
                include('includes/header.php');?>
        <hr style="margin-top:0px;">
    </header>
    <div class="" style="display: flex; margin-top: -16px; width: 100%;">
       
        <?php include('includes/sidebar.php');?>

        <div class="page" style="width: 100%;">
        <?php include('lab-doctor-dashboard.php'); ?>
        </div>
    </div>
</body>

</html>