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
        }, 20000);
    });
</script>
<div class="card-header">
    <p>Admin | Dashboard</p>
</div>
<div class="container-fullw">
    <div class="row">
        <div class="col-sm-4">
            <div class="col">
                <div class="panel panel-white text-center" onclick="window.open('manage-doctors.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/doctors-clipart.png">
                        </div>
                        <h2 class="StepTitle">Menaxho Doktorret</h2>
                        <p class="links cl-effect-1">
                            <?php
                            $query = mysqli_query($con, "SELECT count(id) as count from users where status='1' and (privilege='doctor' OR privilege='lab-doctor')");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
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
                <div class="panel panel-white no-radius text-center" onclick="window.open('patients.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/patients-clipart.png">
                        </div>
                        <h2 class="StepTitle">Menaxho Pacientet</h2>
                        <p class="links cl-effect-1">
                            <?php
                            $query = mysqli_query($con, "SELECT count(id) as count from patients where status='1'");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
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
                <div class="panel panel-white no-radius text-center" onclick="window.open('manage-infirmiers.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/nurses-clipart.png">
                        </div>
                        <h2 class="StepTitle">Menaxho Infermieret</h2>
                        <p class="links cl-effect-1">

                            <?php
                            $query = mysqli_query($con, "SELECT count(id) as count from users where status='1' and privilege='infirmier'");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
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
                <div class="panel panel-white no-radius text-center" onclick="window.open('manage-receptionists.php', '_self');">
                    <div class="panel-body wid">
                        <div class="fa-stack fa-2x image-wid">
                            <img src="img/receptionists-clipart.png">
                        </div>
                        <h2 class=" StepTitle ">Menaxho Recepsionistet</h2>
                        <p class="links cl-effect-1">
                            <?php
                            $query = mysqli_query($con, "SELECT count(id) as count from users where status='1' and privilege='receptionist'");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
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
                                <ul class="list-group pmd-list pmd-card-list pmd-inset-divider" >
                                    <?php
            $query = mysqli_query($con, "SELECT id, name, surname, privilege, online,photo from users WHERE status='1' and id!='$myid' order By online DESC, name ASC");
            if (!$query) {
                                        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                    } else {
                                        while (($data = mysqli_fetch_array($query))) {
                                    ?>
                                            <li id="user-row" class="list-group-item d-flex profile-pic new-ntf" onclick="openChat()">
                                                <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                                    <?php
                                                    if ($data['photo'] == Null) {
                                                    ?>
                                                        <img alt="40x40" src="../img/empty-img.png">
                                                    <?php
                                                    } else {

                                                        echo '<img alt="40x40" src="data:image/jpeg;base64,' . base64_encode($data['photo']) . '" />  ';
                                                    }
                                                    ?>
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="pmd-list-title name-surname Step-title"> <?php echo htmlentities($data['name']); ?> <?php echo htmlentities($data['surname']); ?></h4>
                                                    <p class="pmd-list-subtitle position"> <?php echo htmlentities($data['privilege']); ?></p>
                                                </div>
                                                <?php
                                                if ($data['online'] == 1) {
                                                ?>
                                                    <div class=" status">
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class=" status-offline">
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </li>

                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/chatbox.php'); ?>
</div>