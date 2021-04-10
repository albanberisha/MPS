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
    <title>Receptionist | Caktoni nje termin</title>
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
                <p>Receptionist | Caktoni nje termin</p>
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
                            <td class="pid-h">Nr.</td>
                            <td class="pnameh">Emri</td>
                            <td class="psnameh">Mbiemri</td>
                            <td class="pcontacth">Kontakti</td>
                            <td class="pgenderh">Gjinia</td>
                            <td class="pstatush">Statusi</td>
                            <td class="actionsh">
                            </td>
                        </tr>
                    </table>
                    <table class="data-list">
                        <tbody id="Patients">
                            <?php
                            $query = mysqli_query($con, "SELECT patients.id, patients.patientID, patients.name,patients.surname, patients.phone,patients.gender from patients where patients.status=1 and patients.id IN (SELECT beds.patientId FROM beds)");
                            $query2 = mysqli_query($con, "SELECT patients.id, patients.patientID, patients.name,patients.surname, patients.phone,patients.gender from patients where patients.status=1 and patients.patientID and patients.id NOT IN(SELECT patients.id from patients where patients.status=1 and patients.id IN (SELECT beds.patientId FROM beds))");
                            if (!$query || !$query2) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {

                                while ($data = mysqli_fetch_array($query)) {
                            ?>
                                    <tr>
                                        <td class="pid">
                                            <?php echo htmlentities($data['patientID']); ?>

                                        </td>
                                        <td class="pname">
                                            <?php echo htmlentities($data['name']); ?>

                                        </td>
                                        <td class="psname">
                                            <?php echo htmlentities($data['surname']); ?>

                                        </td>
                                        <td class="pcontact">
                                            <?php echo htmlentities($data['phone']); ?>

                                        </td>
                                        <td class="pgender">
                                            <?php echo htmlentities($data['gender']); ?>

                                        </td>
                                        <td class="pstatus">
                                            Aktiv
                                        </td>
                                        <td class=" actions">
                                            <span class="edit-data">
                                                <a href="create-appointment.php?id=<?php echo $data['id'] ?>&closehistory=patient">
                                                    <img src="img/edit-icon.png">
                                            </span>
                                        </td>
                                    </tr>
                                <?php
                                }
                                while ($data2 = mysqli_fetch_array($query2)) {
                                ?>
                                    <tr>
                                        <td class="pid">
                                            <?php echo htmlentities($data2['patientID']); ?>

                                        </td>
                                        <td class="pname">
                                            <?php echo htmlentities($data2['name']); ?>

                                        </td>
                                        <td class="psname">
                                            <?php echo htmlentities($data2['surname']); ?>

                                        </td>
                                        <td class="pcontact">
                                            <?php echo htmlentities($data2['phone']); ?>

                                        </td>
                                        <td class="pgender">
                                            <?php echo htmlentities($data2['gender']); ?>

                                        </td>
                                        <td class="pstatus">
                                            Jo Aktiv
                                        </td>
                                        <td class=" actions">
                                        <span class="edit-data">
                                                <a href="create-appointment.php?id=<?php echo $data2['id'] ?>&closehistory=patient">
                                                    <img src="img/edit-icon.png">
                                            </span>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                    </table>
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
        name = $('#SearchPatient').val();
        table = 'ActivePatients2'
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