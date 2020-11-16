<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin|dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/sidenavigation.js"></script>
    <script src="js/imagebrowse.js"></script>
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
        <?php include('includes/header.php');?>
        <hr style="margin-top:0px;">
    </header>
    <div class="" style="display: flex; margin-top: -16px; width: 100%;">
        <?php include('includes/sidebar.php');?>

        <div class="page" style="width: 100%;">
            <div class="card-header">
                <p>Admin | Dashboard</p>
            </div>
            <table class="widgets">
                <tr>
                    <td class="w-25 hide">
                        <div class="widget">
                            <div>
                                <p class="wid-info text-center">Data</p>
                                <hr class="divider" align="center">
                            </div>
                            <div>
                                <p class="widget-main-cal text-center">12/02/2020</p>
                            </div>
                        </div>
                    </td>
                    <td class="w-50 hide" colspan="2">
                        <div>
                            <p class="wid-info text-center">Data</p>
                            <hr class="divider" align="center">
                        </div>
                        <div>
                            <p class="widget-main-cal text-center">12/02/2020</p>
                        </div>
                    </td>
                    <td class="w-25 " rowspan="4">
                        <div class="active-users">
                            <div class="widget">
                                <div>
                                    <p class="wid-info text-center">Aktiv</p>
                                    <hr class="divider" align="center">
                                </div>
                                <div class="active-now">
                                    <ul class="list-group pmd-list pmd-card-list pmd-inset-divider">
                                        <li class="list-group-item d-flex profile-pic">
                                            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                                <img alt="40x40" src="img/doctor.png">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="pmd-list-title name-surname">Alban Berisha</h4>
                                                <p class="pmd-list-subtitle position">Doktorr</p>
                                            </div>
                                            <div class="status">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex profile-pic">
                                            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                                <img alt="40x40" src="img/doctor.png">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="pmd-list-title name-surname">Alban Berisha</h4>
                                                <p class="pmd-list-subtitle position">Doktorr</p>
                                            </div>
                                            <div class="status">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex profile-pic">
                                            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                                <img alt="40x40" src="img/doctor.png">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="pmd-list-title name-surname">Alban Berisha</h4>
                                                <p class="pmd-list-subtitle position">Doktorr</p>
                                            </div>
                                            <div class="status">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex profile-pic">
                                            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                                <img alt="40x40" src="img/doctor.png">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="pmd-list-title name-surname">Alban Berisha</h4>
                                                <p class="pmd-list-subtitle position">Doktorr</p>
                                            </div>
                                            <div class="status">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex profile-pic">
                                            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                                <img alt="40x40" src="img/doctor.png">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="pmd-list-title name-surname">Alban Berisha</h4>
                                                <p class="pmd-list-subtitle position">Doktorr</p>
                                            </div>
                                            <div class="status">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex profile-pic">
                                            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                                <img alt="40x40" src="img/doctor.png">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="pmd-list-title name-surname">Alban Berisha</h4>
                                                <p class="pmd-list-subtitle position">Doktorr</p>
                                            </div>
                                            <div class="status">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex profile-pic">
                                            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                                <img alt="40x40" src="img/doctor.png">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="pmd-list-title name-surname">Alban Berisha</h4>
                                                <p class="pmd-list-subtitle position">Doktorr</p>
                                            </div>
                                            <div class="status">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex profile-pic">
                                            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                                <img alt="40x40" src="img/doctor.png">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="pmd-list-title name-surname">Alban Berisha</h4>
                                                <p class="pmd-list-subtitle position">Doktorr</p>
                                            </div>
                                            <div class="status">
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex profile-pic">
                                            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                                                <img alt="40x40" src="img/doctor.png">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="pmd-list-title name-surname">Alban Berisha</h4>
                                                <p class="pmd-list-subtitle position">Doktorr</p>
                                            </div>
                                            <div class="status">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>

                </tr>
                <tr style="margin-top: 20px;">
                    <td class="w-25 hide">
                        <div class="widget">
                            <div>
                                <p class="wid-info text-center">Data</p>
                                <hr class="divider" align="center">
                            </div>
                            <div>
                                <p class="widget-main-cal text-center">12/02/2020</p>
                            </div>
                        </div>
                    </td>
                    <td class="w-25 hide">
                        <div class="widget">
                            <div>
                                <p class="widget-main-cal text-center">Menaxho Doktorret</p>
                                <p class="widget-main-cal text-center">Numri total i doktorreve</p>
                                <p class="widget-main-cal text-center">14</p>
                            </div>
                        </div>
                    </td>
                    <td class="w-25 hide">
                        <div class="widget">
                            <div>
                                <p class="wid-info text-center">Data</p>
                                <hr class="divider" align="center">
                            </div>
                            <div>
                                <p class="widget-main-cal text-center">12/02/2020</p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="w-25 hide">
                        <div class="widget">
                            <div>
                                <p class="wid-info text-center">Data</p>
                                <hr class="divider" align="center">
                            </div>
                            <div>
                                <p class="widget-main-cal text-center">12/02/2020</p>
                            </div>
                        </div>
                    </td>
                    <td class="w-50 hide">
                        <div>
                            <p class="wid-info text-center">Data</p>
                            <hr class="divider" align="center">
                        </div>
                        <div>
                            <p class="widget-main-cal text-center">12/02/2020</p>
                        </div>
                    </td>

                </tr>
            </table>
        </div>
    </div>
</body>

</html>