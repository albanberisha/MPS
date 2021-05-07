<?php
session_start();
error_reporting(0);
include('../includes/config.php');
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
    <p>Receptionist | Paneli i aparaturave</p>
</div>
<div class="container-fullw">
    <div class="row">
        <div class="col-sm-4">
            <div class="col">
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
                                die(mysqli_error($con).$query);                            } else {
                                $data = mysqli_fetch_array($query)
                            ?>
                                Total : <?php echo htmlentities($data['count']); ?>
                            <?php

                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="panel panel-white no-radius text-center" onclick="window.open('rooms.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/beds.png">
                        </div>
                        <h2 class="StepTitle">Shiko dhomat e spitalit</h2>
                        <p class="links cl-effect-1">
                            <?php
                            $query = mysqli_query($con, "SELECT count(id) as count from beds where bedstatus='1' and patientId IS NULL");
                            if (!$query) {
                                die(mysqli_error($con).$query);                            } else {
                                $data = mysqli_fetch_array($query)
                            ?>
                                Gjithsej shtretër të lirë: <?php echo htmlentities($data['count']); ?>
                            <?php

                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="panel panel-white no-radius text-center" onclick="window.open('manage-medicaments.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/supply-icon.png">
                        </div>
                        <h2 class="StepTitle">Menaxhimi i stoqeve dhe furnizimeve</h2>
                        <p class="links cl-effect-1" style="padding-bottom: 25px;">

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
                <div class="panel panel-white no-radius text-center" onclick="window.open('close-history.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/medical-history.png">
                        </div>
                        <h2 class=" StepTitle ">Mbyll historinë</h2>
                        <p class="links cl-effect-1">
                            <?php
                            $query = mysqli_query($con, "SELECT count(id) as count from beds where bedstatus='1' and patientId IS NOT NULL ");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {
                                $data = mysqli_fetch_array($query)
                            ?>
                                Pacientë aktiv : <?php echo htmlentities($data['count']); ?>
                            <?php

                            }
                            ?>
                        </p>
                    </div>
                </div>
                <?php
                /* 
                ?>
                 <div class="panel panel-white no-radius text-center" onclick="window.open('manage-staf.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/working-clipart.png">
                        </div>
                        <h2 class=" StepTitle ">Menaxho stafin dhe oraret</h2>
                        <p class="links cl-effect-1">
                            Staf aktiv :6
                        </p>
                    </div>
                </div>
                <?php */
                ?>
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