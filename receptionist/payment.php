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
$userid = $_SESSION['id'];
$patientid = null;
if (isset($_GET['payment'])) {
    $patientid = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Regjistrim i pacientëve</title>
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
                <p>Receptionist</p>
            </div>
            <div class="container-fullw">
            <?php
$exists = true;
$query = mysqli_query($con, "select patientId from beds where patientId='$patientid' ");
if (!$query) {
    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
} else {
    $data = mysqli_fetch_array($query);
    if ($data <= 0) {
        $exists = false;
    }
}
if ($patientid == NULL || !$exists) {
    echo "Asgje per tu shfaqur";
} else {
    $tvsh = 0.14; //percent
    $total = 0;
?>
    <div class="container" id="Paymentpdf">
        <div class="row ">
            <div id="pdf" class="canvas_div_pdf well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" style="background-color: white; width:100%; margin-left: auto; margin-right : auto;">
                <div>
                    <?php
                    $queryinfo = mysqli_query($con, "SELECT name,initials,state,city,street_address FROM `hospital_details` WHERE id='1'");
                    if (!$queryinfo) {
                        die(mysqli_error($con) . $queryinfo);
                    } else {
                        $data2 = mysqli_fetch_array($queryinfo);
                        $hospitalname = $data2['name'];
                        $hospitalinitials = $data2['initials'];
                        $hospitalinstate = $data2['state'];
                        $hospitalincity = $data2['city'];
                        $hospitalinstreet = $data2['street_address'];
                    }
                    $today = date("Y-m-d H:i:s");
                    $querybillid = mysqli_query($con, "SELECT count(id) as billnumber from bills");
                    if (!$querybillid) {
                        die(mysqli_error($con) . $querybillid);
                    } else {
                        $data1 = mysqli_fetch_array($querybillid);
                        $billnumber = $data1['billnumber'];
                        $billnumber++;
                        $InsertBill = mysqli_query($con, "INSERT INTO bills(id,creationDate,userId,patientId)
                        VALUES('$billnumber','$today','$userid','$patientid')");
                        if (!$InsertBill) {
                            die(mysqli_error($con) . $InsertBill);
                        }
                    }

                    ?>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <address>
                                <strong><?php echo $hospitalname ?></strong>
                                <br>
                                <?php echo $hospitalinitials ?>
                                <br>
                                <?php echo $hospitalinstreet ?>
                                <br>
                                <?php echo $hospitalincity . " ," . $hospitalinstate;  ?>
                            </address>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <p>
                                <em><?php echo $today ?></em>
                            </p>
                            <p>
                                <em>Fature #: <?php echo $billnumber ?></em>
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

                                <?php
                                //analizat
                                $queryanalyzes = mysqli_query($con, "SELECT analyzes.id,pricing_list.name,COUNT(pricing_list.name)as quantity,pricing_list.price from analyzes,pricing_list where analyzes.analyse_id=pricing_list.id and analyzes.patientId='$patientid' and analyzes.bill_Id IS NULL and analyzes.status='1' GROUP by pricing_list.name");
                                if (!$queryanalyzes) {
                                    die(mysqli_error($con) . $queryanalyzes);
                                } else {
                                    while ($dataanalyzes = mysqli_fetch_array($queryanalyzes)) {
                                ?> <tr>
                                            <td class="col-md-9"><em><?php echo htmlentities($dataanalyzes['name']) ?></em></h4>
                                            </td>
                                            <td class="col-md-1" style="text-align: center">
                                                <?php
                                                $quantity = $dataanalyzes['quantity'];
                                                echo $quantity; ?> </td>
                                            <td class="col-md-1 text-center">
                                                <?php
                                                $analyzeprice = $dataanalyzes['price'];
                                                echo "&#128;" . $analyzeprice;
                                                ?></td>
                                            <td class="col-md-1 text-center">
                                                <?php
                                                $totalanalyse = $quantity * $analyzeprice;
                                                echo "&#128;" . $totalanalyse;
                                                $total = $total + $totalanalyse;
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                //update analyzes
                                $updateanalyzes = mysqli_query($con, "UPDATE analyzes SET bill_Id='$billnumber' WHERE  patientId='$patientid' and bill_Id IS NULL");
                                if (!$updateanalyzes) {
                                    die(mysqli_error($con) . $updateanalyzes);
                                }

                                ?>
                                <?php
                                $queryappointments = mysqli_query($con, "SELECT appointments.id, doctors.consultancy_fees,doctors.userId,users.name,users.surname,count(users.id) as quantity from appointments,doctors,users where patientId='$patientid' and appointments.doctorId=doctors.userId and doctors.userId=users.id and date<=CURDATE() and appointments.status!='rejected' and appointments.bill_Id IS NULL GROUP BY doctors.userId");
                                if (!$queryappointments) {
                                    die(mysqli_error($con) . $queryappointments);
                                } else {
                                    while ($dataappointments = mysqli_fetch_array($queryappointments)) {
                                ?>
                                        <tr>
                                            <td class="col-md-9"><em>Termin-<?php echo htmlentities($dataappointments['name']) ?> <?php echo htmlentities($dataappointments['surname']) ?></em></h4>
                                            </td>
                                            <td class="col-md-1" style="text-align: center">
                                                <?php
                                                $quantity = $dataappointments['quantity'];
                                                echo $quantity; ?> </td>
                                            <td class="col-md-1 text-center">
                                                <?php
                                                $appprice = $dataappointments['consultancy_fees'];
                                                echo "&#128;" . $appprice;
                                                ?></td>
                                            <td class="col-md-1 text-center">
                                                <?php
                                                $totalappointments = $quantity * $appprice;
                                                echo "&#128;" . $totalappointments;
                                                $total = $total + $totalappointments;
                                                ?>
                                            </td>
                                        </tr>

                                <?php
                                    }
                                }
                                $updateappountments = mysqli_query($con, "UPDATE appointments SET bill_Id='$billnumber' WHERE patientId='$patientid' and date<=CURDATE() and appointments.status!='rejected' and bill_Id IS NULL ");
                                if (!$updateappountments) {
                                    die(mysqli_error($con) . $updateappountments);
                                }
                                ?>
                                <?php
                                $querymedicaments = mysqli_query($con, "SELECT medicaments.name,med_history.quantity,sum(med_history.quantity) as sum,medicaments.price from medicaments,med_history where med_history.medicamentId=medicaments.id and medicaments.status='1' and med_history.patientId='$patientid' and med_history.bill_Id IS NULL group by med_history.medicamentId");
                                if (!$querymedicaments) {
                                    die(mysqli_error($con) . $querymedicaments);
                                } else {
                                    while ($datamedicaments = mysqli_fetch_array($querymedicaments)) {
                                ?>
                                        <tr>
                                            <td class="col-md-9"><em><?php echo htmlentities($datamedicaments['name']) ?></em></h4>
                                            </td>
                                            <td class="col-md-1" style="text-align: center">
                                                <?php
                                                $quantity = $datamedicaments['sum'];
                                                echo $quantity; ?> </td>
                                            <td class="col-md-1 text-center">
                                                <?php
                                                $medprice = $datamedicaments['price'];
                                                echo "&#128;" . $medprice;
                                                ?></td>
                                            <td class="col-md-1 text-center">
                                                <?php
                                                $totalmedicament = $quantity * $medprice;
                                                echo "&#128;" . $totalmedicament;
                                                $total = $total + $totalmedicament;
                                                ?>
                                            </td>
                                        </tr>

                                <?php
                                    }
                                }
                                $updatemed_hist = mysqli_query($con, "UPDATE med_history SET bill_Id='$billnumber' WHERE patientId='$patientid' and bill_Id IS NULL ");
                                if (!$updatemed_hist) {
                                    die(mysqli_error($con) . $updatemed_hist);
                                }

                                ?>
                                <?php
                                $days = 0;

                                $querypatient = mysqli_query($con, "SELECT id,patientId,entryDateTime,exitDateTime FROM receipts WHERE patientId='$patientid' and exitDateTime IS NULL");
                                if (!$querypatient) {
                                    die(mysqli_error($con) . $querypatient);
                                } else {
                                    $data4 = mysqli_fetch_array($querypatient);
                                    $todayday = date('Y-m-d');
                                    $entered = date('Y-m-d', strtotime($data4['entryDateTime']));
                                    $date1 = date_create($entered);
                                    $date2 = date_create($todayday);
                                    $diff = $date1->diff($date2)->format("%a");
                                    $queryadd_bills = mysqli_query($con, "INSERT INTO additional_bills(pricing_list_Id,added_byUser,creationDate,quantity,bill_Id)VALUES('1','$userid','$today','$diff','$billnumber')");
                                    if (!$queryadd_bills) {
                                        die(mysqli_error($con) . $queryadd_bills);
                                    }
                                }
                                $queryprice = mysqli_query($con, "SELECT id,name,price from pricing_list where status='1' and id='1'");
                                if (!$queryprice) {
                                    die(mysqli_error($con) . $queryprice);
                                } else {
                                    $dataprice = mysqli_fetch_array($queryprice);
                                    $pricepernight = $dataprice['price'];
                                    $namenight = $dataprice['name'];
                                ?>
                                    <tr>
                                        <td class="col-md-9"><em><?php echo htmlentities($dataprice['name']) ?></em></h4>
                                        </td>
                                        <td class="col-md-1" style="text-align: center">
                                            <?php
                                            echo $diff; ?> </td>
                                        <td class="col-md-1 text-center">
                                            <?php
                                            echo "&#128;" . $pricepernight;
                                            ?></td>
                                        <td class="col-md-1 text-center">
                                            <?php
                                            $totalsum = $pricepernight * $diff;
                                            echo "&#128;" . $totalsum;
                                            $total = $total + $totalsum;
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                $querybeds = mysqli_query($con, "UPDATE beds SET patientId=NULL, beds.condition=NULL WHERE patientId='$patientid'");
                                $queryreceipts = mysqli_query($con, "UPDATE receipts SET exitDateTime='$today' WHERE patientId='$patientid' and exitDateTime IS NULL");
                                if (!$querybeds) {
                                    die(mysqli_error($con) . $querybeds);
                                }
                                if (!$queryreceipts) {
                                    die(mysqli_error($con) . $queryreceipts);
                                }
                                ?>
                                <tr>
                                    <td>   </td>
                                    <td class="text-right" colspan="2">
                                        <p>
                                            <strong>Totali ne euro:</strong>
                                        </p>
                                        <p>
                                            <strong>TVSH E: <?php echo ($tvsh * 100) . "%"; ?>  <?php ?></strong>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p>
                                            <strong><?php echo "&#128;" . $total ?></strong>
                                        </p>
                                        <p>
                                            <strong><?php
                                                    $totaltvshEuro = $total * $tvsh;
                                                    echo "&#128;" . $totaltvshEuro ?></strong>
                                        </p>

                                    </td>
                                </tr>
                                <tr>
                                    <td>   </td>
                                    <td class="text-right" colspan="2">
                                        <p>
                                            <strong>Totali pa TVSH: </strong>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p>
                                            <strong><?php
                                                    $totalNoTvsh = $total - $totaltvshEuro;
                                                    echo "&#128;" . $totalNoTvsh ?></strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <h4><strong>Total: </strong></h4>
                                    </td>
                                    <td class="text-center text-danger">
                                        <h4><strong><?php echo $total . "&#128;";
                                                    $queryTotal = mysqli_query($con, "UPDATE bills SET amount='$totalNoTvsh',tvsh='$totaltvshEuro',totalAmount='$total'WHERE id='$billnumber'");
                                                    if (!$queryTotal) {
                                                        die(mysqli_error($con) . $queryTotal);
                                                    }
                                                    ?></strong></h4>

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
<?php
}
?>
            </div>
        </div>
    </div>
</body>

</html>
<script>
        var doc = new jsPDF();


        function printDiv(divId,
            title) {

            let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

            mywindow.document.write(`<html><head><title></title>`);
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


