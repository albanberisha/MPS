<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="js/imagebrowse.js"></script>
    <script>
        $(document).ready(function() {
            $('#widget li').on('click', function() {
                $(this).removeClass('new-ntf');
            });
        });
    </script>
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
            if (widthOutput < 1120) {
                closeChat();
            } else {}
        }

        function closeChat() {
            document.getElementById("Chatbox").style.display = "none";

        }

        function openChat() {
            document.getElementById("Chatbox").style.display = "inline";

        }
        window.onresize = reportWindowSize;
    </script>
</head>

<body onload="reportWindowSize()">
    <header>
        <?php include('includes/header.php');?>
        <hr style="margin-top:0px;">
    </header>
    <div class="" style="display: flex; margin-top: -16px; width: 100%;">
        <?php include('includes/sidebar.php');?>

        <div class="page" style="width: 100%;">
            <div class="card-header">
                <p>Doctor | Dashboard</p>
            </div>
            <div class="container-fullw">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="col">
                            <div class="panel panel-white text-center" onclick="window.open('my-appointments.php', 'mywindow');">
                                <div class="panel-body wid">
                                    <div class="fa-stack fa-2x image-wid">
                                        <img src="img/appointments-clipart.png">
                                    </div>
                                    <h2 class="StepTitle">Terminet e mija</h2>
                                    <p class="links cl-effect-1">
                                        Total Pacientë :6
                                    </p>
                                </div>
                            </div>
                            <div class="panel panel-white text-center" onclick="window.open('register-patients.php', 'mywindow');">
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
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col">
                            <div class="panel panel-white no-radius text-center" onclick="window.open('patient-info.php', 'mywindow');">
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
        </div>
    </div>
</body>

</html>