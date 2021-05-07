<?php
session_start();
error_reporting(0);
include('includes/config.php');
$myid = $_SESSION['id'];
?>
<script>
    $(document).ready(function() {
        setInterval(function() {

            $('#ActiveUsers').load('includes/active-users.php');
        }, 10000);
    });
</script>
<style>
.seenmessage
{
    border-left: 1px solid green;
    border-right: 1px solid green;
}
</style>
    <div class="card-header">
        <p>Doctor | Paneli i aparaturave</p>
    </div>
    <div class="container-fullw">
        <div class="row">
            <div class="col-sm-4">
                <div class="col">
                    <div class="panel panel-white text-center" onclick="window.open('my-appointments.php', '_self');">
                        <div class="panel-body wid">
                            <div class="fa-stack fa-2x image-wid">
                                <img src="img/appointments-clipart.png">
                            </div>
                            <h2 class="StepTitle">Terminet e mija</h2>
                            <p class="links cl-effect-1">
                            <?php
                            $query = mysqli_query($con, "SELECT count(id) as count from appointments where status='approved' and doctorId='$myid'  and date>=CURDATE()");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {
                                $data = mysqli_fetch_array($query)
                            ?>
                                Termine te pa perfunduara: <?php echo htmlentities($data['count']); ?>
                            </p>
                            <?php

                            }
                            ?>
                        </div>
                    </div>
                    <div class="panel panel-white text-center" onclick="window.open('register-patients.php', '_self');">
                        <div class="panel-body wid">
                            <div class="fa-stack fa-2x image-wid">
                                <img src="img/patientregister-clipart.png">
                            </div>
                            <h2 class="StepTitle">Regjistro Pacientë</h2>
                            <p class="links cl-effect-1">
                                <?php
                                $query = mysqli_query($con, "SELECT count(id) as count from patients where status='1'");
                                if (!$query) {
                                    die(mysqli_error($con) . $query);
                                } else {
                                    $data = mysqli_fetch_array($query)
                                ?>
                                    Total : <?php echo htmlentities($data['count']); ?>
                                <?php

                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col">
                <div class="panel panel-white no-radius text-center" onclick="window.open('patient-info.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/patient-info.png">
                        </div>
                        <h2 class="StepTitle">Informata rreth pacientëve</h2>
                        <p class="links cl-effect-1" style="padding-bottom: 25px;">

                        </p>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-sm-4 users">
            <div class="panel panel-white no-radius text-center">
                <div class="panel-body">
                    <div>
                        <p class="wid-info text-center">Aktiv</p>
                        <hr class="divider" align="center">
                    </div>
                    <div class="active-users">
                        <div class="widget" id="widget">
                            <div class="active-now" id="ActiveUsers">
                            <?php include('includes/active-users.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id='MSEq'>
    </div>
    </div>