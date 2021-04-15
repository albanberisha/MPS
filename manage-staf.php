<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receptionist | Menaxho stafin</title>
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
                <p>Receptionist | Menaxho stafin</p>
            </div>
            <div class="container-fullw">
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Stafi aktiv</h5>
                    </div>


                    <div class="panel-body no-padding">
                        <div class="panel-heading">
                            <h6 class="panel-title panel-white text-center">Doktorët</h6>
                        </div>
                        <table class="data-list min-height">
                            <tbody>
                                <tr class="table-head ">
                                    <td class="didh">ID</td>
                                    <td class="dnameh2">Emri</td>
                                    <td class="dsnameh2">Mbiemri</td>
                                    <td class="ddeph2">Departamenti</td>
                                    <td class="dstatush2">Statusi</td>
                                    <td class="dtimeh2">Mbarimi i orarit</td>
                                    <td class="actionsh">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="data-list staf">
                            <tbody>
                                <tr>
                                    <td class="did">
                                        1234234
                                    </td>
                                    <td class="dname2">
                                        Arbnor
                                    </td>
                                    <td class="dsname2">
                                        Berisha
                                    </td>
                                    <td class="ddep2">
                                        Urgjence
                                    </td>
                                    <td class="dstatus2">
                                        Kundestar
                                    </td>
                                    <td class="dtime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-doctor.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="did">
                                        1234234
                                    </td>
                                    <td class="dname2">
                                        Arbnor
                                    </td>
                                    <td class="dsname2">
                                        Berisha
                                    </td>
                                    <td class="ddep2">
                                        Urgjence
                                    </td>
                                    <td class="dstatus2">
                                        Kundestar
                                    </td>
                                    <td class="dtime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-doctor.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="did">
                                        1234234
                                    </td>
                                    <td class="dname2">
                                        Arbnor
                                    </td>
                                    <td class="dsname2">
                                        Berisha
                                    </td>
                                    <td class="ddep2">
                                        Urgjence
                                    </td>
                                    <td class="dstatus2">
                                        Kundestar
                                    </td>
                                    <td class="dtime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-doctor.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="did">
                                        1234234
                                    </td>
                                    <td class="dname2">
                                        Arbnor
                                    </td>
                                    <td class="dsname2">
                                        Berisha
                                    </td>
                                    <td class="ddep2">
                                        Urgjence
                                    </td>
                                    <td class="dstatus2">
                                        Kundestar
                                    </td>
                                    <td class="dtime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-doctor.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="did">
                                        1234234
                                    </td>
                                    <td class="dname2">
                                        Arbnor
                                    </td>
                                    <td class="dsname2">
                                        Berisha
                                    </td>
                                    <td class="ddep2">
                                        Urgjence
                                    </td>
                                    <td class="dstatus2">
                                        Kundestar
                                    </td>
                                    <td class="dtime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-doctor.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="did">
                                        1234234
                                    </td>
                                    <td class="dname2">
                                        Arbnor
                                    </td>
                                    <td class="dsname2">
                                        Berisha
                                    </td>
                                    <td class="ddep2">
                                        Urgjence
                                    </td>
                                    <td class="dstatus2">
                                        Kundestar
                                    </td>
                                    <td class="dtime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-doctor.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="did">
                                        1234234
                                    </td>
                                    <td class="dname2">
                                        Arbnor
                                    </td>
                                    <td class="dsname2">
                                        Berisha
                                    </td>
                                    <td class="ddep2">
                                        Urgjence
                                    </td>
                                    <td class="dstatus2">
                                        Kundestar
                                    </td>
                                    <td class="dtime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-doctor.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="panel-heading" style="border-top: 4px solid rgba(105, 105, 105, 0.2); box-shadow: 0 30px 40px rgba(0,0,0,.1);">
                            <h6 class="panel-title panel-white text-center">Infermierët</h6>
                        </div>
                        <table class="data-list min-height">
                            <tbody>
                                <tr class="table-head ">
                                    <td class="Iidh">ID</td>
                                    <td class="Inameh2">Emri</td>
                                    <td class="Isnameh2">Mbiemri</td>
                                    <td class="Ideph2">Departamenti</td>
                                    <td class="Itimeh2">Mbarimi i orarit</td>
                                    <td class="actionsh">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="data-list staf">
                            <tbody>
                                <tr>
                                    <td class="Iid">
                                        1234234
                                    </td>
                                    <td class="Iname2">
                                        Arbnor
                                    </td>
                                    <td class="Isname2">
                                        Berisha
                                    </td>
                                    <td class="Idep2">
                                        Urgjence
                                    </td>
                                    <td class="Itime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-infermier.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Iid">
                                        1234234
                                    </td>
                                    <td class="Iname2">
                                        Arbnor
                                    </td>
                                    <td class="Isname2">
                                        Berisha
                                    </td>
                                    <td class="Idep2">
                                        Urgjence
                                    </td>
                                    <td class="Itime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-infermier.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Iid">
                                        1234234
                                    </td>
                                    <td class="Iname2">
                                        Arbnor
                                    </td>
                                    <td class="Isname2">
                                        Berisha
                                    </td>
                                    <td class="Idep2">
                                        Urgjence
                                    </td>
                                    <td class="Itime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-infermier.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Iid">
                                        1234234
                                    </td>
                                    <td class="Iname2">
                                        Arbnor
                                    </td>
                                    <td class="Isname2">
                                        Berisha
                                    </td>
                                    <td class="Idep2">
                                        Urgjence
                                    </td>
                                    <td class="Itime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-infermier.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Iid">
                                        1234234
                                    </td>
                                    <td class="Iname2">
                                        Arbnor
                                    </td>
                                    <td class="Isname2">
                                        Berisha
                                    </td>
                                    <td class="Idep2">
                                        Urgjence
                                    </td>
                                    <td class="Itime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-infermier.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Iid">
                                        1234234
                                    </td>
                                    <td class="Iname2">
                                        Arbnor
                                    </td>
                                    <td class="Isname2">
                                        Berisha
                                    </td>
                                    <td class="Idep2">
                                        Urgjence
                                    </td>
                                    <td class="Itime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-infermier.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="Iid">
                                        1234234
                                    </td>
                                    <td class="Iname2">
                                        Arbnor
                                    </td>
                                    <td class="Isname2">
                                        Berisha
                                    </td>
                                    <td class="Idep2">
                                        Urgjence
                                    </td>
                                    <td class="Itime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-infermier.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="panel-heading" style="border-top: 4px solid rgba(105, 105, 105, 0.2); box-shadow: 0 30px 40px rgba(0,0,0,.1);">
                            <h6 class="panel-title panel-white text-center">Stafi tjerë</h6>
                        </div>
                        <table class="data-list min-height">
                            <tbody>
                                <tr class="table-head ">
                                    <td class="sidh">ID</td>
                                    <td class="snameh2">Emri</td>
                                    <td class="ssnameh2">Mbiemri</td>
                                    <td class="sposh2">Pozita</td>
                                    <td class="stimeh2">Mbarimi i orarit</td>
                                    <td class="actionsh">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="data-list staf">
                            <tbody>
                                <tr>
                                    <td class="sid">
                                        1234234
                                    </td>
                                    <td class="sname2">
                                        Arbnor
                                    </td>
                                    <td class="ssname2">
                                        Berisha
                                    </td>
                                    <td class="spos2">
                                        Pastrues
                                    </td>
                                    <td class="stime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('edit-staf.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="panel-heading" style="border-top: 8px solid rgba(105, 105, 105, 0.2);">
                            <h5 class="panel-title panel-white text-center">Stafi joaktiv</h5>
                        </div>
                        <table class="data-list min-height">
                            <tbody>
                                <tr class="table-head ">
                                    <td class="sjidh">ID</td>
                                    <td class="sjnameh2">Emri</td>
                                    <td class="sjsnameh2">Mbiemri</td>
                                    <td class="sjposh2">Pozita</td>
                                    <td class="sjstarttimeh2">Ora e punes</td>
                                    <td class="sjtimeh2">Mbarimi i orarit</td>
                                    <td class="actionsh">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="data-list staf">
                            <tbody>
                                <tr>
                                    <td class="sjid">
                                        1234234
                                    </td>
                                    <td class="sjname2">
                                        Arbnor
                                    </td>
                                    <td class="sjsname2">
                                        Berisha
                                    </td>
                                    <td class="sjpos2">
                                        Pastrues
                                    </td>
                                    <td class="sjstarttime2">
                                        13:45
                                    </td>
                                    <td class="sjtime2">
                                        13:45
                                    </td>
                                    <td class="actions">
                                        <span class="edit-data" onclick="window.open('manage-stafnotset.php', '_self');"><img src="img/edit-icon.png"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>