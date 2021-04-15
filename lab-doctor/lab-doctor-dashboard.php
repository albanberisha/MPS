<?php
session_start();
error_reporting(0);
include('includes/config.php');
$myid = $_SESSION['id'];
?>
<div class="card-header">
                <p>Doktor | Dashboard</p>
            </div>
            <div class="container-fullw">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="col">
                            <div class="panel panel-white text-center" onclick="window.open('results.php', '_self');">
                                <div class="panel-body wid">
                                    <div class="fa-stack fa-2x image-wid">
                                        <img src="img/lab-results-icon.svg">
                                    </div>
                                    <h2 class="StepTitle">Rezultatet laboratorike</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col">
                        <div class="panel panel-white no-radius text-center" onclick="window.open('add-new-results.php', '_self');">
                                <div class="panel-body wid">
                                    <div class="fa-stack fa-2x image-wid">
                                        <img src="img/new-results.svg">
                                    </div>
                                    <h2 class="StepTitle">Vendos rezultate te reja</h2>
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
                <?php include('includes/chatbox.php');?>
            </div>