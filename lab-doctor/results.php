<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doktor | Rezultatet</title>
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
        <?php include('includes/header.php'); ?>
        <hr style="margin-top:0px;">
    </header>
    <div class="" style="display: flex; margin-top: -16px; width: 100%;">
        <?php include('includes/sidebar.php'); ?>

        <div class="page" style="width: 100%;">
            <div class="card-header">
                <p>Doktor | Rezultatet laboratorike</p>
            </div>
            <div class="container-fullw">
                <form class="search-form">
                    <div class="d-inline-flex panel-search">
                        <div class="input-group-prepend">
                            <img class="input-group-text" src="img/search-clipart-btn.png" width="38px" height="38px">
                        </div>
                        <input type="search" class="form-control type-text data-to-search" placeholder="Kerko sipas ID">
                        <button type="submit" class="btn btn-primary btn-send">Kerko</button>
                    </div>
                </form>
                <form>
                <label class="" for="filters">Filtro sipas departamenteve:</label>
            <div class="col-xs-10 col-sm-8 col-md-2" id="filters">
                <select class="selectorfilter form-control selectpicker" name="section_id" >
                    <option value="all">Departamentet</option>
                    <option >I zemres</option>
                    <option >I mushkerive</option>
                </select>
            </div>
                </form>

                <div class="panel-body no-padding" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Rezulatet</h5>
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