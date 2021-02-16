<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doktor | Raport ditor</title>
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
        <?php include('includes/header.php');?>
        <hr style="margin-top:0px;">
    </header>
    <div class="" style="display: flex; margin-top: -16px; width: 100%;">
        <?php include('includes/sidebar.php');?>

        <div class="page" style="width: 100%;">
            <div class="card-header">
                <p>Doktor | Rezultatet e sotme</p>
            </div>
            <div class="container-fullw">

            <div class="panel-body no-padding" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Publikimet e mija te dates <b>24.04.2021</b></h5>
                    </div>
                    <table class="data-list min-height">
                        <tbody>
                            <tr class="table-head ">
                                <td class="rezidh">ID e pacientit</td>
                                <td class="rezdesch">Pershkrimi</td>
                                <td class="rezdateh">Data e krijimit</td>
                                <td class="rezdepth">Departamenti</td>
                                <td class="actionsh">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="data-list">
                        <tbody>
                            <tr>
                                <td class="rezid">
                                    1234234
                                </td>
                                <td class="rezdesc">
                                    Analize e mushkrive
                                </td>
                                <td class="rezdate">
                                    25.12.2020
                                </td>
                                <td class="rezdept">
                                   I mushkerive
                                </td>
                                <td class="actions">
                                    <span class="edit-data" onclick="window.open('edit-result.php', '_self');"><img src="img/edit-icon.png"></span>
                                    <span class="delete-data"><img src="img/delete-icon.png"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="rezid">
                                    1234234
                                </td>
                                <td class="rezdesc">
                                    Analize e mushkrive
                                </td>
                                <td class="rezdate">
                                    25.12.2020
                                </td>
                                <td class="rezdept">
                                   I mushkerive
                                </td>
                                <td class="actions">
                                    <span class="edit-data" onclick="window.open('edit-result.php', '_self');"><img src="img/edit-icon.png"></span>
                                    <span class="delete-data"><img src="img/delete-icon.png"></span>
                                </td>
                            </tr><tr>
                                <td class="rezid">
                                    1234234
                                </td>
                                <td class="rezdesc">
                                    Analize e mushkrive
                                </td>
                                <td class="rezdate">
                                    25.12.2020
                                </td>
                                <td class="rezdept">
                                   I mushkerive
                                </td>
                                <td class="actions">
                                    <span class="edit-data" onclick="window.open('edit-result.php', '_self');"><img src="img/edit-icon.png"></span>
                                    <span class="delete-data"><img src="img/delete-icon.png"></span>
                                </td>
                            </tr><tr>
                                <td class="rezid">
                                    1234234
                                </td>
                                <td class="rezdesc">
                                    Analize e mushkrive
                                </td>
                                <td class="rezdate">
                                    25.12.2020
                                </td>
                                <td class="rezdept">
                                   I mushkerive
                                </td>
                                <td class="actions">
                                    <span class="edit-data" onclick="window.open('edit-result.php', '_self');"><img src="img/edit-icon.png"></span>
                                    <span class="delete-data"><img src="img/delete-icon.png"></span>
                                </td>
                            </tr><tr>
                                <td class="rezid">
                                    1234234
                                </td>
                                <td class="rezdesc">
                                    Analize e mushkrive
                                </td>
                                <td class="rezdate">
                                    25.12.2020
                                </td>
                                <td class="rezdept">
                                   I mushkerive
                                </td>
                                <td class="actions">
                                    <span class="edit-data" onclick="window.open('edit-result.php', '_self');"><img src="img/edit-icon.png"></span>
                                    <span class="delete-data"><img src="img/delete-icon.png"></span>
                                </td>
                            </tr><tr>
                                <td class="rezid">
                                    1234234
                                </td>
                                <td class="rezdesc">
                                    Analize e mushkrive
                                </td>
                                <td class="rezdate">
                                    25.12.2020
                                </td>
                                <td class="rezdept">
                                   I mushkerive
                                </td>
                                <td class="actions">
                                    <span class="edit-data" onclick="window.open('edit-result.php', '_self');"><img src="img/edit-icon.png"></span>
                                    <span class="delete-data"><img src="img/delete-icon.png"></span>
                                </td>
                            </tr><tr>
                                <td class="rezid">
                                    1234234
                                </td>
                                <td class="rezdesc">
                                    Analize e mushkrive
                                </td>
                                <td class="rezdate">
                                    25.12.2020
                                </td>
                                <td class="rezdept">
                                   I mushkerive
                                </td>
                                <td class="actions">
                                    <span class="edit-data" onclick="window.open('edit-result.php', '_self');"><img src="img/edit-icon.png"></span>
                                    <span class="delete-data"><img src="img/delete-icon.png"></span>
                                </td>
                            </tr><tr>
                                <td class="rezid">
                                    1234234
                                </td>
                                <td class="rezdesc">
                                    Analize e mushkrive
                                </td>
                                <td class="rezdate">
                                    25.12.2020
                                </td>
                                <td class="rezdept">
                                   I mushkerive
                                </td>
                                <td class="actions">
                                    <span class="edit-data" onclick="window.open('edit-result.php', '_self');"><img src="img/edit-icon.png"></span>
                                    <span class="delete-data"><img src="img/delete-icon.png"></span>
                                </td>
                            </tr><tr>
                                <td class="rezid">
                                    1234234
                                </td>
                                <td class="rezdesc">
                                    Analize e mushkrive
                                </td>
                                <td class="rezdate">
                                    25.12.2020
                                </td>
                                <td class="rezdept">
                                   I mushkerive
                                </td>
                                <td class="actions">
                                    <span class="edit-data" onclick="window.open('edit-result.php', '_self');"><img src="img/edit-icon.png"></span>
                                    <span class="delete-data"><img src="img/delete-icon.png"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>