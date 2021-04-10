<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after (5 min) hours of inactivity
$minutesBeforeSessionExpire = 5;
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

$userid = null;
if (isset($_GET['death'])) {
    $userid = $_GET['id'];
}
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Mbyll historine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

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
    <script>
        var doc = new jsPDF();

        function saveDiv(divId, title) {
            doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
            doc.save('div.pdf');
        }

        function printDiv(divId,
            title) {

            let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

            mywindow.document.write(`<html><head><title>${title}</title>`);
            mywindow.document.write('</head><body >');
            mywindow.document.write(document.getElementById(divId).innerHTML);
            mywindow.document.write('</body></html>');
            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }
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
                <p>Receptionist | Mbyll historine</p>
            </div>
            <div class="container-fullw" id="container-fullw">
                <div class="container" id="Paymentpdf">
                    <div class="row ">
                        <div id="pdf" class="canvas_div_pdf well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" style="background-color: white; width:100%; margin-left: auto; margin-right : auto;">
                            <div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <address>
                                            <strong>QKUK</strong>
                                            <br>
                                            10000
                                            <br>
                                            Prishtine, Kosove
                                            <br>
                                            <abbr title="Phone">Kontakti:</abbr> (213) 484-6829
                                        </address>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                        <p>
                                            <em>Data: 1st November, 2013</em>
                                        </p>
                                        <p>
                                            <em>Fature #: 34522677W</em>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-center">
                                        <h1>Fature</h1>
                                    </div>
                                    </span>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Produkti</th>
                                                <th>Sasia</th>
                                                <th class="text-center">Qmimi</th>
                                                <th class="text-center">Totali</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-md-9"><em>Nate ne spital</em></h4>
                                                </td>
                                                <td class="col-md-1" style="text-align: center"> 2 </td>
                                                <td class="col-md-1 text-center">$13</td>
                                                <td class="col-md-1 text-center">$26</td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-9"><em>Analize</em></h4>
                                                </td>
                                                <td class="col-md-1" style="text-align: center"> 1 </td>
                                                <td class="col-md-1 text-center">$8</td>
                                                <td class="col-md-1 text-center">$8</td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-9"><em>Infuzione</em></h4>
                                                </td>
                                                <td class="col-md-1" style="text-align: center"> 3 </td>
                                                <td class="col-md-1 text-center">$16</td>
                                                <td class="col-md-1 text-center">$48</td>
                                            </tr>
                                            <tr>
                                                <td>   </td>
                                                <td>   </td>
                                                <td class="text-right">
                                                    <p>
                                                        <strong>Totali: </strong>
                                                    </p>
                                                    <p>
                                                        <strong>TVSH: </strong>
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p>
                                                        <strong>$6.94</strong>
                                                    </p>
                                                    <p>
                                                        <strong>$6.94</strong>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>   </td>
                                                <td>   </td>
                                                <td class="text-right">
                                                    <p>
                                                        <strong>Totali: </strong>
                                                    </p>
                                                    <p>
                                                        <strong>TVSH: </strong>
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p>
                                                        <strong>$6.94</strong>
                                                    </p>
                                                    <p>
                                                        <strong>$6.94</strong>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    <h4><strong>Total: </strong></h4>
                                                </td>
                                                <td class="text-center text-danger">
                                                    <h4><strong>$31.53</strong></h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="printDiv('pdf','Title')" id="PaymentBill" class="btn btn-success btn-lg btn-block">
                        Printo  <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>