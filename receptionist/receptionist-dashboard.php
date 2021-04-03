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
    <p>Receptionist | Dashboard</p>
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
                            Total Pacientë :6
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
                            Gjithsej shtretër të lirë: 17
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
                            Pacientë aktiv :6
                        </p>
                    </div>
                </div>
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

                            <div class="active-now">
                                <ul class="list-group pmd-list pmd-card-list pmd-inset-divider">
                                    <li id="user-row" class="list-group-item d-flex profile-pic new-ntf" onclick="openChat()">
                                        <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                            <img alt="40x40" src="img/doctor.png">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="pmd-list-title name-surname Step-title">Albdfgdfan Berisha</h4>
                                            <p class="pmd-list-subtitle position">Doktorr</p>
                                        </div>
                                        <div class="status">
                                        </div>
                                    </li>
                                    <li id="user-row" class="list-group-item d-flex profile-pic new-ntf" onclick="openChat()">
                                        <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                            <img alt="40x40" src="img/doctor.png">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="pmd-list-title name-surname Step-title">Alban Berisha</h4>
                                            <p class="pmd-list-subtitle position">Doktorr</p>
                                        </div>
                                        <div class="status">
                                        </div>
                                    </li>
                                    <li id="user-row" class="list-group-item d-flex profile-pic new-ntf" onclick="openChat()">
                                        <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                            <img alt="40x40" src="img/doctor.png">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="pmd-list-title name-surname Step-title">blerim</h4>
                                            <p class="pmd-list-subtitle position">Doktorr</p>
                                        </div>
                                        <div class="status">
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex profile-pic" onclick="openChat()">
                                        <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                            <img alt="40x40" src="img/doctor.png">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="pmd-list-title name-surname Step-title">Alban Berisha</h4>
                                            <p class="pmd-list-subtitle position">Doktorr</p>
                                        </div>
                                        <div class="status">
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex profile-pic" onclick="openChat()">
                                        <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                            <img alt="40x40" src="img/doctor.png">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="pmd-list-title name-surname Step-title">Alban Berisha</h4>
                                            <p class="pmd-list-subtitle position">Doktorr</p>
                                        </div>
                                        <div class="status">
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex profile-pic" onclick="openChat()">
                                        <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                            <img alt="40x40" src="img/doctor.png">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="pmd-list-title name-surname Step-title">Alban Berisha</h4>
                                            <p class="pmd-list-subtitle position">Doktorr</p>
                                        </div>
                                        <div class="status">
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex profile-pic" onclick="openChat()">
                                        <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                            <img alt="40x40" src="img/doctor.png">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="pmd-list-title name-surname Step-title">Alban Berisha</h4>
                                            <p class="pmd-list-subtitle position">Doktorr</p>
                                        </div>
                                        <div class="status">
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex profile-pic" onclick="openChat()">
                                        <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                            <img alt="40x40" src="img/doctor.png">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="pmd-list-title name-surname Step-title">Alban Berisha</h4>
                                            <p class="pmd-list-subtitle position">Doktorr</p>
                                        </div>
                                        <div class="status">
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex profile-pic" onclick="openChat()">
                                        <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                            <img alt="40x40" src="img/doctor.png">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="pmd-list-title name-surname Step-title">Alban Berisha</h4>
                                            <p class="pmd-list-subtitle position">Doktorr</p>
                                        </div>
                                        <div class="status">
                                        </div>
                                    </li>
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