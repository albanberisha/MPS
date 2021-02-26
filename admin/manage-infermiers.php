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
    <title>Admin | Menaxho Infermieret</title>
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
                <p>Admin | Menaxho Infermieret</p>
            </div>
            <div class="container-fullw">
                <form class="search-form">
                    <div class="d-inline-flex panel-search">
                        <div class="input-group-prepend">
                            <img class="input-group-text" src="img/search-clipart-btn.png" width="38px" height="38px">
                        </div>
                        <input type="search" class="form-control type-text data-to-search" placeholder="Kerko sipas emrit">
                        <button type="submit" class="btn btn-primary btn-send">Kerko</button>
                    </div>
                </form>
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Infermieret</h5>
                    </div>
                    <table class="data-list min-height">
                        <tr class="table-head ">
                            <td class="iidh">ID</td>
                            <td class="inameh">Emri</td>
                            <td class="isnameh">Mbiemri</td>
                            <td class="ideph">Departamenti</td>
                            <td class="actionsh">
                            </td>
                        </tr>
                    </table>
                    <table class="data-list">
                        <tr>
                            <td class="iid">
                                1234234
                            </td>
                            <td class="iname">
                                Alban34234234234
                            </td>
                            <td class="isname">
                                Berisha234234324
                            </td>
                            <td class="idep">
                                Lindjet
                            </td>
                            <td class="actions">
                                <span class="edit-data" onclick="window.open('edit-infermier.php', '_self');"><img src="img/edit-icon.png"></span>
                                <span class="delete-data"><img src="img/delete-icon.png"></span>
                            </td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>