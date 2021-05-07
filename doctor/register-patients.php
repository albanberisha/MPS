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
    <title>Doctor | Regjistrim i pacientëve</title>
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
                <p>Doktor | Regjistrim i pacientëve</p>
            </div>
            <div class="container-fullw">
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Forma e regjistrimit</h5>
                    </div>
                    <form class="search-form" id="search_form" method="post" style="margin-left: 10px;">
                        <div class="d-inline-flex panel-search">
                            <div class="input-group-prepend">
                                <img class="input-group-text" src="img/search-clipart-btn.png" width="38px" height="38px">
                            </div>
                            <input type="search" name="search-patient" id="SearchPatient" class="form-control type-text data-to-search" placeholder="Kerko sipas ID">
                            <button type="submit" class="btn btn-primary btn-send">Kerko</button>
                            <button type="button" id="Refresh" class="btn btn-primary btn-send"><img class="" src="../img/refresh.png" width="20px" height="20px">
                            </button>
                        </div>
                        <p id="Searcherror" style="color:red;"></p>
                    </form>
                    <div class="panel-search" id="Error" style="margin-left: 20px;">
                        <p id="Searcherror" style="color:red;"></p>
                    </div>
                    <div class="panel-body no-padding" id="Patients" hidden>
                        <div>
                        </div>
                    </div>
                    <h6 class="panel-title panel-white important2">Gjendja sipas kategorive:</h6>
                    <div class="btn-group " role="group" style="width: 100%;">
                        <div class="row-cols-sm-20p">
                            <a href="red-condition.php" type="button" class="btn btn-secondary" style=" background: red; border:1px solid rgb(255, 142, 142); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast emergjent. Kerkohet intervenim i menjehershem per shpetim te jetes. Riskt te madh per humbje te jetes.">Kuqe</a>
                        </div>
                        <div class="row-cols-sm-20p">
                            <a href="yellow-condition.php" type="button" class="btn btn-secondary" style="background: yellow; border:1px solid rgb(199, 199, 105); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast urgjent. Kerkohen shume resurse mirpo jo rreizk per jeten. Rast potencial resioz">Verdhë</a>
                        </div>
                        <div class="row-cols-sm-20p">
                            <a href="green-condition.php" type="button" class="btn btn-secondary" style="background: green; border:1px solid rgb(128, 253, 128); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast me pak urgjent. Intervenim standard.">Gjelbër</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $("#Refresh").on('click', function() {
        location.reload();
    });
    $("#search_form").submit(function(e) {
        e.preventDefault();
        patientname = $('#SearchPatient').val();
        table = 'patients'
        $.ajax({
                method: "POST",
                url: "includes/search.inc.php",
                data: {
                    name: patientname,
                    table: table
                }
            })
            .done(function(response) {
                if (response == "error") {
                    $('#Searcherror').html("Ky pacient nuk eziston. Regjistro pacientin e ri me poshte!");
                    document.getElementById("Patients").hidden = true;
                    document.getElementById("Searcherror").hidden = false;
                } else {
                    document.getElementById("Patients").hidden = false;
                    $("#Patients").html(response);

                    document.getElementById("Searcherror").hidden = true;
                }
            });
        return false;
    });
</script>