<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/logincheck.php');
check_login();
//Ending a php session after 1(60 min) hours of inactivity
$minutesBeforeSessionExpire = 60;
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
    <title>Receptionist | Historia e regjistrimeve</title>
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
                <p>Receptionist | Historia e regjistrimeve</p>
            </div>
            <div class="container-fullw">
                <form class="search-form" id="search_form" method="post">
                    <div class="d-inline-flex panel-search">
                        <div class="input-group-prepend">
                            <img class="input-group-text" src="img/search-clipart-btn.png" width="38px" height="38px">
                        </div>
                        <input type="search" name="search-patient" id="SearchPatient" class="form-control type-text data-to-search" placeholder="Kerko sipas emrit">
                        <button type="submit" class="btn btn-primary btn-send">Kerko</button>
                        <button type="button" id="Refresh" class="btn btn-primary btn-send"><img class="" src="../img/refresh.png" width="20px" height="20px">
                        </button>
                    </div>
                    <p id="Searcherror" style="color:red;"></p>
                </form>
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Pacientët</h5>
                    </div>
                    <table class="data-list min-height">
                        <tr class="table-head ">
                            <td class="rid-h">Nr.</td>
                            <td class="rnameh2">ID</td>
                            <td class="rsnameh2">Emri dhe Mbiemri</td>
                            <td class="rrecepsh">Personi pergjegjes</td>
                            <td class="rdateh">Data dhe ora</td>
                            <td class="rtimeh">Gjendja</td>
                        </tr>
                    </table>
                    <table class="data-list datalist-3">
                        <tbody id="Patients">
                            <?php
                            $query = mysqli_query($con, "SELECT receipts.id, receipts.patientId,patients.patientID as patID, receipts.entryDateTime, users.name as username, users.surname as usersurname, patients.name as patientname, patients.surname as patientsurname, receipts.cond from receipts, users, patients where receipts.patientId=patients.id and receipts.userInCharge=users.id ORDER BY receipts.id DESC LIMIT 25");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {
                                $count = 1;
                                while (($data = mysqli_fetch_array($query))) {
                                    $timestamp = $data['entryDateTime'];
                                    $splitTimeStamp = explode(" ", $timestamp);
                                    $date = $splitTimeStamp[0];
                                    $time = $splitTimeStamp[1];
                            ?>
                                    <tr>
                                        <td class="rid"><?php echo $count; ?></td>
                                        <td class="rname2"><?php echo htmlentities($data['patID']); ?></td>
                                        <td class="rsname2"><?php echo htmlentities($data['patientname']); ?> <?php echo htmlentities($data['patientsurname']); ?></td>
                                        <td class="rreceps"><?php echo htmlentities($data['username']); ?> <?php echo htmlentities($data['usersurname']); ?></td>
                                        <td class="rdate"><?php echo $date; ?> <?php echo $time; ?></td>
                                        <td class="rtime"><?php
                                                            $condition = $data['cond'];
                                                            switch ($condition) {
                                                                case "red":
                                                            ?>
                                                    <a href="#" type="button" class="btn btn-secondary" style=" background: red; border:1px solid rgb(255, 142, 142); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast emergjent. Kerkohet intervenim i menjehershem per shpetim te jetes. Riskt te madh per humbje te jetes.">Kuqe</a>
                                                <?php
                                                                    break;
                                                                case "yellow":
                                                ?>
                                                    <a href="#" type="button" class="btn btn-secondary" style="background: yellow; border:1px solid rgb(199, 199, 105); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast urgjent. Kerkohen shume resurse mirpo jo rreizk per jeten. Rast potencial resioz">Verdhë</a>
                                                <?php
                                                                    break;
                                                                default:
                                                ?>
                                                    <a href="#" type="button" class="btn btn-secondary" style="background: green; border:1px solid rgb(128, 253, 128); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast me pak urgjent. Intervenim standard.">Gjelbër</a>

                                            <?php
                                                            }
                                            ?>
                                        </td>
                                    </tr>
                            <?php
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
        $("#Refresh").on('click', function()
        {
            location.reload();
        });

        $("#search_form").submit(function(e) {
            e.preventDefault();
            name = $('#SearchPatient').val();
            table = 'searchpatients'
            $.ajax({
                    method: "POST",
                    url: "includes/search.inc.php",
                    data: {
                        name: name,
                        table: table
                    }
                })
                .done(function(response) {
                    if (response == "error") {
                        $('#Searcherror').html("Format i pa lejuar!");
                    } else {
                        $('#Searcherror').html("");
                        $("#Patients").html(response);
                    }
                });
            return false;
        });
    </script>