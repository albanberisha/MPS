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
    <title>Admin | Pacientët</title>
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
                <p>Admin | Pacientët</p>
            </div>
            <div class="container-fullw">
                <div class="panel-body no-padding">
                    <table border="1" class="table table-bordered">
                        <tbody>
                            <tr align="center">
                                <td colspan="4" style="font-size:20px;">
                                    Detajet e pacientit</td>
                            </tr>

                            <tr>
                            <th scope="">Emri</th>
                                <td>Artan</td>
                            <th scope="">Mbiemri</th>
                                <td>Dreshaj</td>
                                
                            </tr>
                            <tr>
                            <th scope="">Id</th>
                                <td>45678</td>
                            
                                <th scope="">Kontakti</th>
                                <td>4558968789</td>
                            </tr>
                            <tr>
                            <th>Adresa</th>
                                <td>Rruga Xhamil Dreshaj</td>
                                <th scope="">Emaili</th>
                                <td>test@gmail.com</td>
                            </tr> 
                            <tr>
                            <th>Gjinia</th>
                                <td>Mashkull</td>
                                <th>Date e regjistrimit</th>
                                <td>2019-11-04 22:38:06</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>