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
    <title>Admin | Ndrysho Medikamentin</title>
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
                <p>Admin | Ndrysho Medikamentin</p>
            </div>
            <div class=" container-fullw">
                <div class="panel-body">
                    <div class="panel-heading">
                        <h5 class="panel-title">Paracetamoll</h5>
                        <div class="info-panel">
                            <div class="d-inline-flex">
                                <h6 class="panel-title">Regjistruar me:</h6>
                                <p class="reg-date">21.12.2020</p>
                            </div>
                            <div class="d-inline-flex">
                                <h6 class="panel-title">Hera e fundit e perditesimit:</h6>
                                <p class="update-date">21.12.2020</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-form">
                        <form>
                            <div class="form-group">
                                <label class="input-title">Emri i medikamentit</label>
                                <input type="text" id="nameMed" class="form-control" placeholder="Sheno emrin e medikamentit" value="Paracetamoll">
                            </div>
                            <div class="form-group">
                                <label class="input-title">Emri i prodhuesit</label>
                                <input type="text" id="nameProd" class="form-control" placeholder="Sheno emrin e prodhuesit" value="Prodhuesi">
                            </div>
                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Masa</label>
                                    <input type="text" id="massProd" class="form-control" placeholder="Sheno masen e medikamentit(p.sh 10ml)" value="100 ml">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Sasia</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="quantityProd" class="form-control" placeholder="Sheno sasine" value="200">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cop&euml;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Pershkrimi</label>
                                <textarea class="form-control" rows="5" id="description" placeholder="Pershkrimi i medikamentit">Produkt shume i mire akhfakshlflkasjghkl</textarea>
                            </div>

                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Data e prodhimit</label>
                                    <input type="date" class="form-control" id="Manufacturestart-date" name="manufacturestart_date" value="2018-08-09" />
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Data e skadimit</label>
                                    <input type="date" class="form-control" id="Expiaryestart-date" name="expiarystart_date"value="2021-08-09"  />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">	
                                    &Ccedil;mimi</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">&#8364</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="&Ccedil;mimi i medikamentit" value="0.30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Barkodi</label>
                                <div class="input-group mb-3">
                                    <input id="barcode" class="form-control" style="background-image: url(img/barcode.png)" value="1234567891012">
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-primary">Ndrysho</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>