<!DOCTYPE html>
<html lang="en">

<head>
    <title>Doctor | Regjistrim i pacientëve</title>
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
                <p>Doctor | Regjistrim i pacientëve</p>
            </div>
            <div class="container-fullw">
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Forma e regjistrimit</h5>
                    </div>
                    <form class="search-form" style="margin-left: 10px;">
                        <div class="d-inline-flex panel-search">
                            <div class="input-group-prepend">
                                <img class="input-group-text" src="img/search-clipart-btn.png" width="38px" height="38px">
                            </div>
                            <input type="search" class="form-control type-text data-to-search" placeholder="Kerko sipas ID">
                            <button type="submit" class="btn btn-primary btn-send">Kerko</button>
                        </div>
                    </form>
                    <div class="panel-body no-padding">
                        <div class="panel-search" style="margin-left: 20px;">
                            <label style="color: red;">Ky pacient nuk eziston. Regjistro pacientin e ri me poshte. Nese egziston direkt formen e plotsume edhe pacienti behet aktiv ne spital</label>
                        </div>
                        <div>
                            <table class="data-list min-height">
                                <tbody>
                                <tr class="table-head ">
                            <td class="pid-h">ID</td>
                            <td class="pnameh">Emri</td>
                            <td class="psnameh">Mbiemri</td>
                            <td class="pcontacth">Kontakti</td>
                            <td class="pgenderh">Gjinia</td>
                            <td class="pstatush">Statusi</td>
                            <td class="actionsh">
                            </td>
                        </tr>
                                </tbody>
                            </table>
                            <table class="data-list staf">
                                <tbody>
                                <tr>
                            <td class="pid">
                                1234234
                            </td>
                            <td class="pname">
                                Alban34234234234
                            </td>
                            <td class="psname">
                                Berisha234234324
                            </td>
                            <td class="pcontact">
                                044528369
                            </td>
                            <td class="pgender">
                               Mashkull
                            </td>
                            <td class="pstatus">
                               Jo Aktiv
                            </td>
                            <td class="actions">
                            <span class="edit-data" onclick="window.open('reg-patient.php', '_self');"><img src="img/edit-icon.png"></span>
                                <span class="edit-data" onclick="window.open('view-patient.php', '_self');"><img src="img/eye-icon.png"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pid">
                                1234234
                            </td>
                            <td class="pname">
                                Alban34234234234
                            </td>
                            <td class="psname">
                                Berisha234234324
                            </td>
                            <td class="pcontact">
                                044528369
                            </td>
                            <td class="pgender">
                               Mashkull
                            </td>
                            <td class="pstatus">
                               aktiv
                            </td>
                            <td class="actions">
                                <span class="edit-data" onclick="window.open('view-patient.php', '_self');"><img src="img/eye-icon.png"></span>
                            </td>
                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h6 class="panel-title panel-white important2">Gjendja sipas kategorive:</h6>
                    <div class="btn-group " role="group" style="width: 100%;">
                        <div class="row-cols-sm-20p">
                            <a href="red-condition.php" type="button" class="btn btn-secondary" style=" background: red; border:1px solid rgb(255, 142, 142); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast emergjent. Kerkohet intervenim i menjehershem per shpetim te jetes. Riskt te madh per humbje te jetes.">Kuqe</a>
                        </div>
                        <div class="row-cols-sm-20p">
                            <a href="yellow-condition.php" type="button" class="btn btn-secondary" style="background: yellow; border:1px solid rgb(199, 199, 105); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast urgjent. Kerkohen shume resurse mirpo jo rreizk per jeten. Rast potencial resioz">Verdhë</a>
                        </div>
                        <div class="row-cols-sm-20p">
                            <a href="green-condition.php" type="button" class="btn btn-secondary" style="background: green; border:1px solid rgb(128, 253, 128); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast me pak urgjent. Intervenim standard.">Gjelbër</a>
                        </div>
                        <div class="row-cols-sm-20p">
                            <a href="death-form.php" type="button" class="btn btn-secondary " style="background: black; border:1px solid rgb(105, 105, 105); color: #fff" data-toggle="tooltip" data-placement="bottom" title="Rast vdekje">Zezë</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>