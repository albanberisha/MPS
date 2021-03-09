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
    <title>Admin | Shto Medikamente</title>
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
                <p>Admin | Shto Medikamente</p>
            </div>
            <div class=" container-fullw">
                <div class="panel-body">
                    <div class="panel-heading">
                        <h5 class="panel-title">Shto nje medikament</h5>
                    </div>
                    <div class="panel-form">
                        <form method="POST" id="AddMedicamentsFrom" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="input-title">Emri i medikamentit</label>
                                <input type="text" id="NameMed" name="nameMed" class="form-control" placeholder="Sheno emrin e medikamentit">
                                <span id="Nameerror" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Emri i prodhuesit</label>
                                <input type="text" id="NameProd" name="nameProd" class="form-control" placeholder="Sheno emrin e prodhuesit">
                                <span id="ProdNameerror" style="color: red;"></span>
                            </div>
                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Masa</label>
                                    <input type="text" id="MassProd" name="massProd" class="form-control" placeholder="Sheno masen e medikamentit(p.sh 10ml)">
                                    <span id="Masserror" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Sasia</label>
                                    <div class="input-group mb-3">
                                        <input type="number"  min="0" id="QuantityProd" name="quantityProd" class="form-control" placeholder="Sheno sasine">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cop&euml;</span>
                                        </div>
                                    </div>
                                    <span id="Quantityeerror" style="color: red;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Sasia nen te cilen do ta pranoni mesazhin per sasi jo te mjaftueshme te produktit ne stock.</label>
                                <div class="input-group mb-3">
                                    <input type="number" min="0" id="QuantityProdStock" name="quantityProdStock" class="form-control" placeholder="Sheno sasine">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cop&euml;</span>
                                    </div>
                                </div>
                                <span id="Quantityeerror2" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Pershkrimi</label>
                                <textarea class="form-control" rows="5"  maxlength="200" id="Description" name="description" placeholder="Pershkrimi i medikamentit"></textarea>
                                <span id="Descriptionerror" style="color: red;"></span>
                            </div>

                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Data e prodhimit</label>
                                    <input type="date" class="form-control" id="Manufacturestart-date" name="manufacturestart_date" />
                                    <span id="StartDateerror" style="color: red;"></span>
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Data e skadimit</label>
                                    <input type="date" class="form-control" id="Expiaryestart-date" name="expiarystart_date" />
                                    <span id="ExpDateerror" style="color: red;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">
                                    &Ccedil;mimi</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">&#8364</span>
                                    </div>
                                    <input type="number" step="0.01" id="Price"  min="0" name="price" class="form-control" placeholder="&Ccedil;mimi i medikamentit">
                                </div>
                                <span id="Priceerror" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Barkodi</label>
                                <div class="input-group mb-3">
                                    <input id="barcode"  name="barcode" class="form-control" style="background-image: url(img/barcode.png)">
                                </div>
                                <span id="Barcodeerror" style="color: red;"></span>

                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-primary">Regjistro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $("#AddMedicamentsFrom").submit(function(e) {
        e.preventDefault();
        $('#Nameerror').html("");
        $('#ProdNameerror').html("");
        $('#Masserror').html("");
        $('#Quantityeerror').html("");
        $('#Quantityeerror2').html("");
        $('#Descriptionerror').html("");
        $('#StartDateerror').html("");
        $('#ExpDateerror').html("");
        $('#Priceerror').html("");
        $('#Barcodeerror').html("");

        var myform = document.getElementById("AddMedicamentsFrom");
        var fd = new FormData(myform);
        $.ajax({
                url: "includes/add-medicament.inc.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
                $message = "";
                switch (response) {
                    case "19":
                        $message = "Emri nuk mund te jete i zbrazet ose te permbaje karaktere speicale.";
                        $('#Nameerror').html($message);
                        document.getElementById('Nameerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "20":
                        $message = "Emri nuk mund te jete i zbrazet ose te permbaje karaktere speicale.";
                        $('#ProdNameerror').html($message);
                        document.getElementById('ProdNameerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "21":
                        $message = "Nuk mund te jete e zbrazet apo te permbaje karaktere speciale.";
                        $('#Masserror').html($message);
                        document.getElementById('Masserror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "22":
                        $message = "Sasia nuk mund te jete numer negativ.";
                        $('#Quantityeerror').html($message);
                        document.getElementById('Quantityeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "23":
                        $message = "Sasia nuk mund te jete numer negativ.";
                        $('#Quantityeerror2').html($message);
                        document.getElementById('Quantityeerror2').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "24":
                        $message = "Pershkrimi nuk mund te permbaje karaktere speciale.";
                        $('#Descriptionerror').html($message);
                        document.getElementById('Descriptionerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "25":
                        $message = "Nuk mund te jete e zbrazet.";
                        $('#StartDateerror').html($message);
                        document.getElementById('StartDateerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "26":
                        $message = "Date jo valide e prodhimit.";
                        $('#StartDateerror').html($message);
                        document.getElementById('StartDateerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "27":
                        $message = "Data e skadimit nuk mund te jete e zbrazet.";
                        $('#ExpDateerror').html($message);
                        document.getElementById('ExpDateerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "28":
                        $message = "Date jo valide e skadimit.";
                        $('#ExpDateerror').html($message);
                        document.getElementById('ExpDateerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "29":
                        $message = "Qmimi nuk mund te jete negativ e as i zbrazet.";
                        $('#Priceerror').html($message);
                        document.getElementById('Priceerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    case "30":
                        $message = "Barkod jo valid.";
                        $('#Barcodeerror').html($message);
                        document.getElementById('Barcodeerror').scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        break;
                    default:
                        alert("Te dhenat u ruajten me sukses");
                        window.location.href = response;
                }
            });
        return false;
    });
</script>